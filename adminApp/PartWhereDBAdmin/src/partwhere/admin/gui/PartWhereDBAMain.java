package partwhere.admin.gui;

import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.Menu;

import java.util.Map;

import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.MenuItem;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.custom.CTabFolder;
import org.eclipse.swt.custom.CTabItem;
import org.eclipse.swt.custom.SashForm;
import org.eclipse.swt.widgets.Tree;
import org.eclipse.swt.widgets.TreeItem;

import partwhere.admin.sql.DBConnection;
import partwhere.admin.sql.DataManager;
import partwhere.admin.sql.Part;
import partwhere.admin.sql.PartType;
import partwhere.admin.sql.Screw;

import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.events.SelectionListener;
import org.eclipse.swt.custom.CTabFolder2Adapter;
import org.eclipse.swt.custom.CTabFolderEvent;

public class PartWhereDBAMain {

	protected Shell shlPartwhereDbAdmin;
	private Tree tree;
	private CTabFolder tabManager;
	private TreeItem root = null;
	
	private MenuItem mntmAddPartType;
	private MenuItem mntmAddScrew;
	/**
	 * Launch the application.
	 * @param args
	 */
	public static void main(String[] args) {
		try {
			PartWhereDBAMain window = new PartWhereDBAMain();
			window.open();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Open the window.
	 */
	public void open() {
		Display display = Display.getDefault();
		createContents();
		shlPartwhereDbAdmin.open();
		shlPartwhereDbAdmin.layout();
		while (!shlPartwhereDbAdmin.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
	}

	private void close()
	{
		shlPartwhereDbAdmin.close();
	}
	public Shell getShell() {
		return shlPartwhereDbAdmin;
	}

	/**
	 * Create contents of the window.
	 */
	protected void createContents() {
		shlPartwhereDbAdmin = new Shell();
		shlPartwhereDbAdmin.setSize(765, 541);
		shlPartwhereDbAdmin.setText("PartWhere DB Admin");
		shlPartwhereDbAdmin.setLayout(new GridLayout(1, false));
		
		Menu menu = new Menu(shlPartwhereDbAdmin, SWT.BAR);
		shlPartwhereDbAdmin.setMenuBar(menu);
		
		MenuItem mntmFileMenu = new MenuItem(menu, SWT.CASCADE);
		mntmFileMenu.setText("File");
		
		Menu menuFile = new Menu(mntmFileMenu);
		mntmFileMenu.setMenu(menuFile);
		
		MenuItem mntmExit = new MenuItem(menuFile, SWT.NONE);
		mntmExit.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				close();
			}
		});
		mntmExit.setText("Exit");
		
		SashForm sashForm = new SashForm(shlPartwhereDbAdmin, SWT.BORDER | SWT.SMOOTH);
		GridData gd_sashForm = new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1);
		gd_sashForm.heightHint = 472;
		gd_sashForm.widthHint = 742;
		sashForm.setLayoutData(gd_sashForm);
		
		tree = new Tree(sashForm, SWT.BORDER);
		tree.addMouseListener(new org.eclipse.swt.events.MouseAdapter() {
			@Override
			public void mouseDoubleClick(org.eclipse.swt.events.MouseEvent e) {
				treeItemDoubleClick();
			}
		});
		tree.addSelectionListener(new SelectionListener() {
			
			@Override
			public void widgetSelected(SelectionEvent e) {
				selectionChanged();
			}
			
			@Override
			public void widgetDefaultSelected(SelectionEvent e) {
				widgetSelected(e);
			}
		});
		root = new TreeItem(tree, SWT.NONE);
		root.setText(0, "Part Types");
		
		Menu menu_1 = new Menu(tree);
		tree.setMenu(menu_1);
		
		mntmAddPartType = new MenuItem(menu_1, SWT.NONE);
		mntmAddPartType.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				createPartType();
			}
		});
		mntmAddPartType.setEnabled(false);
		mntmAddPartType.setText("Add Part Type");
		
		mntmAddScrew = new MenuItem(menu_1, SWT.NONE);
		mntmAddScrew.setEnabled(false);
		mntmAddScrew.setText("Add Screw");
		
		MenuItem mntmAddBolt = new MenuItem(menu_1, SWT.NONE);
		mntmAddBolt.setText("Add Bolt");
		mntmAddBolt.setEnabled(false);
		
		MenuItem mntmAddNut = new MenuItem(menu_1, SWT.NONE);
		mntmAddNut.setText("Add Nut");
		mntmAddNut.setEnabled(false);
		
		MenuItem mntmAddWasher = new MenuItem(menu_1, SWT.NONE);
		mntmAddWasher.setText("Add Washer");
		mntmAddWasher.setEnabled(false);
		mntmAddScrew.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent e) {
				createScrew();
			}
		});
		
		loadPartTypes();

		
		tabManager = new CTabFolder(sashForm, SWT.CLOSE);
		tabManager.addCTabFolder2Listener(new CTabFolder2Adapter() {
			@Override
			public void close(CTabFolderEvent event) {
				event.doit = confirmTabClose(event);
			}
		});
		sashForm.setWeights(new int[] {176, 552});

	}
	
	public void selectionChanged() {
		if(tree.getSelectionCount() > 0)
		{
			TreeItem [] selected = tree.getSelection();
			if(selected != null)
			{
				mntmAddPartType.setEnabled(true);
				TreeItem firstSel= selected[0];
				Object selectedObject = firstSel.getData();
				if(selectedObject instanceof PartType)
				{
					// does this part have children?
					PartType selPart = (PartType)selectedObject;
					if(selPart.getChildren().isEmpty())
					{
						mntmAddScrew.setEnabled(true);
						Map<Long, Part> partsForType = DataManager.getInstance().getLoadedPartsForType(selPart.getPartTypeId());
						if(partsForType == null)
						{
							// load associated parts
							if(DBConnection.getInstance().loadParts(selPart.getPartTypeId(),
									DataManager.getInstance()) > 0)
							{
								partsForType = DataManager.getInstance().getLoadedPartsForType(selPart.getPartTypeId());
							}
						}
						if(partsForType != null)
						{
							for(Part child: partsForType.values())
							{
								addPartToTree(child, firstSel);
							}
						}
					}
				}
			}
			else
			{
				mntmAddScrew.setEnabled(false);
				mntmAddPartType.setEnabled(false);
			}
		}		
	}
	
	private boolean confirmTabClose(CTabFolderEvent event)
	{
		boolean closetab = true;
		CTabItem tab = (CTabItem)event.item;
		Object data = tab.getControl();
		if(data instanceof EditorTab &&
				((EditorTab)data).hasPendingChanges())
		{
			MessageBox confirmClose = new MessageBox(shlPartwhereDbAdmin, SWT.ICON_QUESTION | SWT.YES | SWT.NO | SWT.CANCEL);
			String msg = "There are pending changes.  Would you like to save these before closing?";
			confirmClose.setMessage(msg);
			confirmClose.setText("Confirm Close");
			int result = confirmClose.open();
			if(result == SWT.YES)
			{
				// save changes first
				((EditorTab)data).saveEdits();
			}
			else if(result == SWT.CANCEL)
			{
				closetab = false;
			}
		}
		return closetab;
	}
	
	private void treeItemDoubleClick() {
		TreeItem[] selItems = tree.getSelection();
		if(selItems != null)
		{
			TreeItem selectedType = selItems[0];
			Object selObj = selectedType.getData();
			if(selObj != null)
			{
				if(selObj instanceof PartType)
				{
					showPartTypeEditor(selectedType, false);
				}
				else if(selObj instanceof Part)
				{
					showScrewEditor(selectedType, false);
				}
			}
		}		
	}

	private void loadPartTypes()
	{
		if(DBConnection.getInstance().loadPartTypes(DataManager.getInstance()))
		{
			Map<Long, PartType> partTypes = DataManager.getInstance().getLoadedPartTypes();
			if(!partTypes.isEmpty())
			{
				for(PartType type : partTypes.values())
				{
					addPartTypeToTree(type, root);
				}
			}
		}
	}
	
	private void createScrew()
	{
		Screw addScrew = new Screw();
		addScrew.setName("New Screw");
		TreeItem parent = root;
		if(tree.getSelectionCount() == 1)
		{
			parent = tree.getSelection()[0];
			PartType parentType = (PartType)parent.getData();
			if(parentType != null)
			{
				addScrew.setPartId(parentType.getPartTypeId());
			}
		}
		TreeItem item = addPartToTree(addScrew, parent);
		showScrewEditor(item, true);
	}
	
	private void createPartType()
	{
		PartType newPartType = new PartType();
		newPartType.setName("New Part Type");
		TreeItem parent = root;
		if(tree.getSelectionCount() == 1)
		{
			parent = tree.getSelection()[0];
			PartType parentType = (PartType)parent.getData();
			if(parentType != null)
			{
				newPartType.setParent(parentType);
			}
		}
		TreeItem item = addPartTypeToTree(newPartType, parent);
		showPartTypeEditor(item, true);
	}
	
	private TreeItem addPartTypeToTree(PartType type, TreeItem parent) {
		
		TreeItem newType = new TreeItem(parent, 0);
		newType.setData(type);
		newType.setText(type.getName());
		for(PartType child: type.getChildren())
		{
			addPartTypeToTree(child, newType);
		}
		return newType;
	}

	private TreeItem addPartToTree(Part part, TreeItem parent) {
		TreeItem addedPart = new TreeItem(parent, 0);
		addedPart.setData(part);
		addedPart.setText(part.getName());
		return addedPart;
	}

	private void showScrewEditor(TreeItem item, boolean addNew)
	{
		
	}


	private void showPartTypeEditor(TreeItem item, boolean addNew)
	{
		PartType partTypeToEdit = (PartType)item.getData();
		String name = partTypeToEdit.getName();
		if(addNew)
		{
			name = "New Part";
		}
		int curTabs = tabManager.getItemCount();
		CTabItem newTab = new CTabItem(tabManager, 0);
		newTab.setText(name);
		newTab.setData(partTypeToEdit);
		PartTypeEditor panel = new PartTypeEditor(tabManager, 0, item, this);
		newTab.setControl(panel);

		// index is one less than item count, because it is 0-based, so the index of the new tab
		// is equal to the item count prior to creating the new tab.
		tabManager.setSelection(curTabs);
	}

	public boolean updatePartType(TreeItem item, boolean nameChanged) {
		// save changes to database
		PartType partType = (PartType)item.getData();
		boolean success = DBConnection.getInstance().savePartType(partType, DataManager.getInstance()); 
		// new part type
		if(success)
		{
			// if name changed, update tree and tab name
			CTabItem current = tabManager.getSelection();
			if(nameChanged)
			{
				if(current != null)
				{
					current.setText(partType.getName());
				}
				item.setText(partType.getName());
				tree.update();
			}			
		}
		else
		{
			// database save failed
			MessageBox saveFailed = new MessageBox(shlPartwhereDbAdmin, SWT.ICON_ERROR | SWT.OK);
			saveFailed.setMessage("Failed to save part type to the database. "
					+ " See error log for more details.");
			saveFailed.setText("Part Type Save Failed");
			saveFailed.open();
		}
		return success;
	}
}
