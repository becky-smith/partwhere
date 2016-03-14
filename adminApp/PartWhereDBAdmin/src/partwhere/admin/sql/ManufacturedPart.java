package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:13:47 AM
 */
public class ManufacturedPart {

	private Long ManufacturedPartId;
	private Part ReferencedPart;
	private Manufacturer ReferencedManufacturer;

	private Boolean dirty = false;

	public ManufacturedPart(){

	}

	public void finalize() throws Throwable {

	}

	public Long getManufacturedPartId() {
		return ManufacturedPartId;
	}

	public void setManufacturedPartId(Long manufacturedPartId) {
		ManufacturedPartId = manufacturedPartId;
	}

	public Part getReferencedPart() {
		return ReferencedPart;
	}

	public void setReferencedPart(Part referencedPart) {
		ReferencedPart = referencedPart;
	}

	public Manufacturer getReferencedManufacturer() {
		return ReferencedManufacturer;
	}

	public void setReferencedManufacturer(Manufacturer referencedManufacturer) {
		ReferencedManufacturer = referencedManufacturer;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

}