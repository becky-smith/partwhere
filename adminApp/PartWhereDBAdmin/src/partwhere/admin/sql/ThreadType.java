package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:12:10 AM
 */
public class ThreadType {

	private Long ThreadId;
	private String Name;
	private Boolean Male = true;
	private Boolean RightHanded = true;
	private ISOMetricThreadStandard ISOStandard = null;
	private UnifiedThreadStandard UTSStandard = null;

	private Boolean dirty = false;

	public ThreadType(){

	}

	public void finalize() throws Throwable {

	}

	public Long getThreadId() {
		return ThreadId;
	}

	public void setThreadId(Long threadId) {
		ThreadId = threadId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public Boolean getMale() {
		return Male;
	}

	public void setMale(Boolean male) {
		Male = male;
	}

	public Boolean getRightHanded() {
		return RightHanded;
	}

	public void setRightHanded(Boolean rightHanded) {
		RightHanded = rightHanded;
	}

	public ISOMetricThreadStandard getISOStandard() {
		return ISOStandard;
	}

	public void setISOStandard(ISOMetricThreadStandard iSOStandard) {
		ISOStandard = iSOStandard;
	}

	public UnifiedThreadStandard getUTSStandard() {
		return UTSStandard;
	}

	public void setUTSStandard(UnifiedThreadStandard uTSStandard) {
		UTSStandard = uTSStandard;
	}
	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

	public void update(ThreadType newType)
	{
		setName(newType.getName());
	}

}