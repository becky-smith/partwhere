package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:14:18 AM
 */
public class CatalogEntry {

	private Long CatalogEntryId;
	private Integer Quantity = 1;
	private Float Price;
	private ManufacturedPart ReferencedPart;
	
	private Boolean dirty = false;

	public CatalogEntry(){

	}

	public void finalize() throws Throwable {

	}

	public Long getCatalogEntryId() {
		return CatalogEntryId;
	}

	public void setCatalogEntryId(Long catalogEntryId) {
		CatalogEntryId = catalogEntryId;
	}

	public Integer getQuantity() {
		return Quantity;
	}

	public void setQuantity(Integer quantity) {
		Quantity = quantity;
	}

	public Float getPrice() {
		return Price;
	}

	public void setPrice(Float price) {
		Price = price;
	}

	public ManufacturedPart getReferencedPart() {
		return ReferencedPart;
	}

	public void setReferencedPart(ManufacturedPart referencedPart) {
		ReferencedPart = referencedPart;
	}

	public Boolean getDirty() {
		return dirty;
	}
	
	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}
}