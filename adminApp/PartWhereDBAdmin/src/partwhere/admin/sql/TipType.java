package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:11:55 AM
 */
public class TipType {

	private Long TipTypeId;
	private String Name;
	private String Description;
	private String ImagePath;

	private Boolean dirty = false;

	public TipType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getTipTypeId() {
		return TipTypeId;
	}

	public void setTipTypeId(Long tipTypeId) {
		TipTypeId = tipTypeId;
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

	public void update(TipType newType)
	{
		setName(newType.getName());
		setDescription(newType.getDescription());
		setImagePath(newType.getImagePath());
	}

}