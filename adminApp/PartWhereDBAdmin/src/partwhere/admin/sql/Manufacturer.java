package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:13:38 AM
 */
public class Manufacturer {

	private Long ManufacturerId;
	private String Name;
	private String ContactName;
	private String ContactEmail;
	private String ContactPhone;
	private String Website;

	private Boolean dirty = false;

	public Manufacturer(){

	}

	public void finalize() throws Throwable {

	}

	public Long getManufacturerId() {
		return ManufacturerId;
	}

	public void setManufacturerId(Long manufacturerId) {
		ManufacturerId = manufacturerId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public String getContactName() {
		return ContactName;
	}

	public void setContactName(String contactName) {
		ContactName = contactName;
	}

	public String getContactEmail() {
		return ContactEmail;
	}

	public void setContactEmail(String contactEmail) {
		ContactEmail = contactEmail;
	}

	public String getContactPhone() {
		return ContactPhone;
	}

	public void setContactPhone(String contactPhone) {
		ContactPhone = contactPhone;
	}

	public String getWebsite() {
		return Website;
	}

	public void setWebsite(String website) {
		Website = website;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

}