package partwhere.admin.gui;

import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.FileDialog;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.widgets.Shell;

import java.io.File;

import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.Text;
import org.eclipse.swt.widgets.TreeItem;

import partwhere.admin.sql.DataManager;
import partwhere.admin.sql.PartType;

import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.events.KeyAdapter;
import org.eclipse.swt.events.KeyEvent;

public class PartTypeEditor extends Composite implements EditorTab {
	private Text textName;
	private Text textImgFile;
	private PartType partType = null;
	private Button btnApply;
	private Button btnCancel;
	private Shell shlParent;
	private PartWhereDBAMain owner = null;
	private TreeItem treeItem = null;

	/**
	 * Create the composite.
	 * @param parent
	 * @param style
	 */
	public PartTypeEditor(Composite parent, int style, TreeItem item, PartWhereDBAMain main) {
		super(parent, style);
		owner = main;
		shlParent = main.getShell();
		partType = (PartType)item.getData();
		treeItem = item;
		setLayout(new GridLayout(4, false));
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		Label lblName = new Label(this, SWT.NONE);
		lblName.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblName.setText("Name");
		
		textName = new Text(this, SWT.BORDER);
		textName.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				setButtonsEnabled();
			}
		});
		textName.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		textName.setText(partType.getName());
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		Label lblImagepath = new Label(this, SWT.NONE);
		lblImagepath.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblImagepath.setText("Image File");
		
		textImgFile = new Text(this, SWT.BORDER);
		textImgFile.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		textImgFile.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				setButtonsEnabled();
			}
		});
		
		String imgPath = partType.getImagePath();
		if(imgPath != null && !imgPath.isEmpty())
		{
			textImgFile.setText(imgPath);
		}
		
		Button btnBrowse = new Button(this, SWT.NONE);
		btnBrowse.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				browseImagePath();
			}
		});
		btnBrowse.setText("...");
		new Label(this, SWT.NONE);
		
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		btnApply = new Button(this, SWT.NONE);
		btnApply.setEnabled(false);
		btnApply.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				saveEdits();
			}
		});
		btnApply.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		btnApply.setText("Apply");
		
		btnCancel = new Button(this, SWT.NONE);
		btnCancel.setEnabled(false);
		btnCancel.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				cancelEdits();
			}
		});
		btnCancel.setText("Cancel");
		new Label(this, SWT.NONE);

	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}

	public PartType getPartType() {
		return partType;
	}

	public void setPartType(PartType partType) {
		this.partType = partType;
	}

	public TreeItem getTreeItem() {
		return treeItem;
	}

	public void setButtonsEnabled()
	{
		// name cannot be empty, so the evaluation for enabling
		// apply has a slightly different requirement than the
		// evaluation for enabling cancel

		btnApply.setEnabled(!textName.getText().isEmpty() &&
				(nameChanged() || imgPathChanged()));
		btnCancel.setEnabled((nameChanged() || imgPathChanged()));
	}
	
	private boolean nameChanged()
	{
		String curName = partType.getName();
		String newName = textName.getText();
		return (curName != null && newName.compareTo(curName) != 0) ||
			(curName == null && !newName.isEmpty());	
	}

	private boolean imgPathChanged()
	{
		String curPath = partType.getImagePath();
		String newPath = textImgFile.getText();
		return (curPath != null && newPath.compareTo(curPath) != 0) ||
			(curPath == null && !newPath.isEmpty());			
	}

	private void browseImagePath()
	{
		FileDialog findImage = new FileDialog(shlParent, SWT.OPEN);
		findImage.setFilterNames(new String [] {"Image Files", "All Files"});
		findImage.setFilterExtensions(new String[] {"*.png;*.jpg;*.gif", "*.*"});
		findImage.setFilterIndex(0);
		File basePath = new File(DataManager.getInstance().getBaseImagePath());
		if(basePath != null && basePath.exists())
		{
			findImage.setFilterPath(basePath.getAbsolutePath());
		}
	    String selectedFile = findImage.open();
	    if(selectedFile != null) {
		    File selFile = new File(selectedFile);
	    	textImgFile.setText(selFile.getName());
	    	setButtonsEnabled();
	    }
	}
	private void cancelEdits()
	{
		// confirm?
		boolean cancel = true;
		if(nameChanged() || imgPathChanged())
		{
			MessageBox confirm = new MessageBox(shlParent, SWT.ICON_QUESTION | SWT.YES | SWT.NO);
			confirm.setMessage("Cancel Edits?");
			confirm.setText("Confirm Cancel");
			if(confirm.open() == SWT.NO)
			{
				cancel = false;
			}
		}
		if(cancel)
		{
			// reset values and disable apply
			textName.setText(partType.getName());
			textImgFile.setText(partType.getImagePath());
			setButtonsEnabled();
		}
	}
	@Override
	public void saveEdits()
	{
		boolean updatedName = nameChanged();
		if(updatedName)
		{
			partType.setName(textName.getText());
		}
		if(imgPathChanged())
		{
			partType.setImagePath(textImgFile.getText());
		}
		if(owner.updatePartType(treeItem, updatedName))
		{
			setButtonsEnabled();
		}
	}

	@Override
	public boolean hasPendingChanges() {
		return btnApply.isEnabled();
	}

}
