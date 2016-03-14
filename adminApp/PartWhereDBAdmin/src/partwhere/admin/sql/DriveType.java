package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:14:09 AM
 */
public class DriveType {

	private Long DriveTypeId;
	private String Name;
	private String AlternateName;
	private String Abbreviation;

	private Boolean dirty = false;

	public DriveType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getDriveTypeId() {
		return DriveTypeId;
	}

	public void setDriveTypeId(Long driveTypeId) {
		DriveTypeId = driveTypeId;
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

	public String getAbbreviation() {
		return Abbreviation;
	}

	public void setAbbreviation(String abbreviation) {
		Abbreviation = abbreviation;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public void update(DriveType newType)
	{
		setName(newType.getName());
		setAlternateName(newType.getAlternateName());
		setAbbreviation(newType.getAbbreviation());
	}

}