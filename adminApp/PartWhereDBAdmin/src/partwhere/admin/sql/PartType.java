package partwhere.admin.sql;

import java.util.ArrayList;

/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:12:26 AM
 */
public class PartType {

	private Long PartTypeId = null;
	private String Name;
	private PartType parent = null;
	private ArrayList<PartType> children = new ArrayList<PartType>();
	private String ImagePath;

	private Boolean dirty = false;

	public PartType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getPartTypeId() {
		return PartTypeId;
	}

	public void setPartTypeId(Long partTypeId) {
		PartTypeId = partTypeId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public ArrayList<PartType> getChildren() {
		return children;
	}

	public void addChild(PartType child) {
		children.add(child);
	}

	public String getImagePath() {
		return ImagePath;
	}

	public void setImagePath(String imagePath) {
		ImagePath = imagePath;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public PartType getParent() {
		return parent;
	}

	public void setParent(PartType parent) {
		this.parent = parent;
	}

	public void update(PartType newPartType) {
		setName(newPartType.getName());
		setImagePath(newPartType.getImagePath());
		ArrayList<PartType> copyChildren = newPartType.getChildren();
		for(PartType child : copyChildren)
		{
			addChild(child);
		}
	}

	@Override
	public String toString() {
		return getName();
	}

}