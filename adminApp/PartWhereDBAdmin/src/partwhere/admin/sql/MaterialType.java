package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:13:28 AM
 */
public class MaterialType {

	private Long MaterialTypeId;
	private String Name;
	private String Description;

	private Boolean dirty = false;

	public MaterialType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getMaterialTypeId() {
		return MaterialTypeId;
	}

	public void setMaterialTypeId(Long materialTypeId) {
		MaterialTypeId = materialTypeId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public String getDescription() {
		return Description;
	}

	public void setDescription(String description) {
		Description = description;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public void update(MaterialType newType) {
		// TODO Auto-generated method stub
		Name = newType.getName();
		Description = newType.getDescription();
	}


}