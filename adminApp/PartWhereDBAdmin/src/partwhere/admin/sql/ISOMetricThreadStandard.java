package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:13:56 AM
 */
public class ISOMetricThreadStandard {

	private Long ISOId;
	private String Name;
	private String Abbreviation;
	private Float NominalDiameter;
	private Float CoarsePitch;
	private Float FinePitch;
	private Float AlternateFinePitch;

	private Boolean dirty = false;

	public ISOMetricThreadStandard(){

	}

	public void finalize() throws Throwable {

	}

	public Long getISOId() {
		return ISOId;
	}

	public void setISOId(Long iSOId) {
		ISOId = iSOId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public String getAbbreviation() {
		return Abbreviation;
	}

	public void setAbbreviation(String abbreviation) {
		Abbreviation = abbreviation;
	}

	public Float getNominalDiameter() {
		return NominalDiameter;
	}

	public void setNominalDiameter(Float nominalDiameter) {
		NominalDiameter = nominalDiameter;
	}

	public Float getCoarsePitch() {
		return CoarsePitch;
	}

	public void setCoarsePitch(Float coarsePitch) {
		CoarsePitch = coarsePitch;
	}

	public Float getFinePitch() {
		return FinePitch;
	}

	public void setFinePitch(Float finePitch) {
		FinePitch = finePitch;
	}

	public Float getAlternateFinePitch() {
		return AlternateFinePitch;
	}

	public void setAlternateFinePitch(Float alternateFinePitch) {
		AlternateFinePitch = alternateFinePitch;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

}