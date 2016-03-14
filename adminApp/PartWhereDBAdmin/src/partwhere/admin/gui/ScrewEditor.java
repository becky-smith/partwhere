package partwhere.admin.gui;

import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.widgets.Shell;

import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.Text;
import org.eclipse.swt.widgets.TreeItem;

import partwhere.admin.sql.PartDataAccess;
import partwhere.admin.sql.Screw;

import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.events.KeyAdapter;
import org.eclipse.swt.events.KeyEvent;
import org.eclipse.swt.widgets.Combo;

public class ScrewEditor extends Composite implements EditorTab {
	private Text textName;
	private Screw screwData = null;
	private Button btnApply;
	private Button btnCancel;
	private Shell shlParent;
	private PartWhereDBAMain owner = null;
	private TreeItem treeItem = null;
	private Label lblDiameter;
	private Label lblLength;
	private Label lblHead;
	private Label lblTipType;
	private Label lblDriveType;
	private Label lblThread;
	private Label lblImageFile;
	private Text textImgFile;
	private Text textDiameter;
	private Text textLength;
	private Combo comboDiameterUnits;
	private Combo comboLengthUnits;
	private Combo comboHead;
	private Combo comboTip;
	private Combo comboDrive;
	private Combo comboThread;
	private Button button;

	/**
	 * Create the composite.
	 * @param parent
	 * @param style
	 */
	public ScrewEditor(Composite parent, int style, TreeItem item, PartWhereDBAMain main) {
		super(parent, style);
		owner = main;
		shlParent = main.getShell();
		screwData = (Screw)item.getData();
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
		textName.setText(screwData.getName());
		
		String imgPath = screwData.getImagePath();
		if(imgPath != null && !imgPath.isEmpty())
		{
			textImgFile.setText(imgPath);
		}
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		lblImageFile = new Label(this, SWT.NONE);
		lblImageFile.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblImageFile.setText("Image File");
		
		textImgFile = new Text(this, SWT.BORDER);
		textImgFile.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		
		button = new Button(this, SWT.NONE);
		button.setText("...");
		new Label(this, SWT.NONE);
		
		lblDiameter = new Label(this, SWT.NONE);
		lblDiameter.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblDiameter.setText("Diameter");
		
		textDiameter = new Text(this, SWT.BORDER);
		textDiameter.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		
		comboDiameterUnits = new Combo(this, SWT.NONE);
		comboDiameterUnits.setLayoutData(new GridData(SWT.LEFT, SWT.CENTER, false, false, 1, 1));
		new Label(this, SWT.NONE);
		
		lblLength = new Label(this, SWT.NONE);
		lblLength.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblLength.setText("Length");
		
		textLength = new Text(this, SWT.BORDER);
		textLength.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		
		comboLengthUnits = new Combo(this, SWT.NONE);
		comboLengthUnits.setLayoutData(new GridData(SWT.LEFT, SWT.CENTER, false, false, 1, 1));
		new Label(this, SWT.NONE);
		
		lblHead = new Label(this, SWT.NONE);
		lblHead.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblHead.setText("Head");
		
		comboHead = new Combo(this, SWT.NONE);
		comboHead.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		lblTipType = new Label(this, SWT.NONE);
		lblTipType.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblTipType.setText("Tip");
		
		comboTip = new Combo(this, SWT.NONE);
		comboTip.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		lblDriveType = new Label(this, SWT.NONE);
		lblDriveType.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblDriveType.setText("Drive");
		
		comboDrive = new Combo(this, SWT.NONE);
		comboDrive.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		new Label(this, SWT.NONE);
		new Label(this, SWT.NONE);
		
		lblThread = new Label(this, SWT.NONE);
		lblThread.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblThread.setText("Thread");
		
		comboThread = new Combo(this, SWT.NONE);
		comboThread.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		new Label(this, SWT.NONE);
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
	
	public void loadComboOptions(PartDataAccess data)
	{
		
	}

	public Screw getScrewData() {
		return screwData;
	}

	public void setScrewData(Screw screwData) {
		this.screwData = screwData;
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
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
		String curName = screwData.getName();
		String newName = textName.getText();
		return (curName != null && newName.compareTo(curName) != 0) ||
			(curName == null && !newName.isEmpty());	
	}

	private boolean imgPathChanged()
	{
		String curPath = screwData.getImagePath();
		String newPath = textImgFile.getText();
		return (curPath != null && newPath.compareTo(curPath) != 0) ||
			(curPath == null && !newPath.isEmpty());			
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
			textName.setText(screwData.getName());
			textImgFile.setText(screwData.getImagePath());
			setButtonsEnabled();
		}
	}
	@Override
	public void saveEdits()
	{
		boolean updatedName = nameChanged();
		if(updatedName)
		{
			screwData.setName(textName.getText());
		}
		if(imgPathChanged())
		{
			screwData.setImagePath(textImgFile.getText());
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
