package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:11:46 AM
 */
public class UnifiedThreadStandard {

	private Long UTSId;
	private String Name;
	private String Abbreviation;
	private String NominalDiameterInch;
	private String NominalDiameterMM;
	private Float CoarsePitchInch;
	private Float FinePitchInch;
	private Float ExtraFinePitchInch;
	private Integer CoarseTPI;
	private Integer FineTPI;
	private Integer ExtraFineTPI;
	private Float CoarsePitchMM;
	private Float FinePitchMM;
	private Float ExtraFinePitchMM;

	private Boolean dirty = false;

	public UnifiedThreadStandard(){

	}

	public void finalize() throws Throwable {

	}

	public Long getUTSId() {
		return UTSId;
	}

	public void setUTSId(Long uTSId) {
		UTSId = uTSId;
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

	public String getNominalDiameterInch() {
		return NominalDiameterInch;
	}

	public void setNominalDiameterInch(String nominalDiameter) {
		NominalDiameterInch = nominalDiameter;
	}

	public String getNominalDiameterMM() {
		return NominalDiameterMM;
	}

	public void setNominalDiameterMM(String nominalDiameter) {
		NominalDiameterMM = nominalDiameter;
	}

	public Float getCoarsePitchInch() {
		return CoarsePitchInch;
	}

	public void setCoarsePitchInch(Float coarsePitchInch) {
		CoarsePitchInch = coarsePitchInch;
	}

	public Float getFinePitchInch() {
		return FinePitchInch;
	}

	public void setFinePitchInch(Float finePitchInch) {
		FinePitchInch = finePitchInch;
	}

	public Float getExtraFinePitchInch() {
		return ExtraFinePitchInch;
	}

	public void setExtraFinePitchInch(Float extraFinePitchInch) {
		ExtraFinePitchInch = extraFinePitchInch;
	}

	public Integer getCoarseTPI() {
		return CoarseTPI;
	}

	public void setCoarseTPI(Integer coarseTPI) {
		CoarseTPI = coarseTPI;
	}

	public Integer getFineTPI() {
		return FineTPI;
	}

	public void setFineTPI(Integer fineTPI) {
		FineTPI = fineTPI;
	}

	public Integer getExtraFineTPI() {
		return ExtraFineTPI;
	}

	public void setExtraFineTPI(Integer extraFineTPI) {
		ExtraFineTPI = extraFineTPI;
	}

	public Float getCoarsePitchMM() {
		return CoarsePitchMM;
	}

	public void setCoarsePitchMM(Float coarsePitchMM) {
		CoarsePitchMM = coarsePitchMM;
	}

	public Float getFinePitchMM() {
		return FinePitchMM;
	}

	public void setFinePitchMM(Float finePitchMM) {
		FinePitchMM = finePitchMM;
	}

	public Float getExtraFinePitchMM() {
		return ExtraFinePitchMM;
	}

	public void setExtraFinePitchMM(Float extraFinePitchMM) {
		ExtraFinePitchMM = extraFinePitchMM;
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

}