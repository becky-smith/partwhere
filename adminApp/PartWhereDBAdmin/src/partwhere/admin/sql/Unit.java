package partwhere.admin.sql;


/**
 * This enumeration table captures the possible units of measurement that may be
 * used.
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:11:38 AM
 */
public class Unit {

	private Long UnitId;
	private String Name;
	private Boolean dirty = false;

	public Unit(){

	}

	public void finalize() throws Throwable {

	}

	public Long getUnitId() {
		return UnitId;
	}

	public void setUnitId(Long unitId) {
		UnitId = unitId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public void update(Unit newType)
	{
		setName(newType.getName());
	}
}