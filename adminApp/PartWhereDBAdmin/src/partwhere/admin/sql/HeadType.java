package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:14:03 AM
 */
public class HeadType {

	private Long HeadTypeId;
	private String Name;
	private String AlternateName;

	private Boolean dirty = false;

	public HeadType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getHeadTypeId() {
		return HeadTypeId;
	}

	public void setHeadTypeId(Long headTypeId) {
		HeadTypeId = headTypeId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public String getAlternateName() {
		return AlternateName;
	}

	public void setAlternateName(String alternateName) {
		AlternateName = alternateName;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public void update(HeadType newType) {
		setName(newType.getName());
		setAlternateName(newType.getAlternateName());
	}

}