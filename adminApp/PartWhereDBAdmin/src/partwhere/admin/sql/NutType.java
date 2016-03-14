package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:12:53 AM
 */
public class NutType {

	private Long NutTypeId;
	private String Name;
	private String AlternateName;
	private String Description;
	private String ImagePath;

	private Boolean dirty = false;

	public NutType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getNutTypeId() {
		return NutTypeId;
	}

	public void setNutTypeId(Long nutTypeId) {
		NutTypeId = nutTypeId;
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

	public String getDescription() {
		return Description;
	}

	public void setDescription(String description) {
		Description = description;
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

	public void update(NutType newType)
	{
		setName(newType.getName());
		setAlternateName(newType.getAlternateName());
		setDescription(newType.getDescription());
		setImagePath(newType.getImagePath());
	}

}