package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:13:03 AM
 */
public class Nut extends Part{

	private Long NutId;
	private String Name;
	private ThreadType ThreadType;
	private String Diameter;
	private Unit DiameterUnits;
	private NutType NutType;

	public Nut(){

	}

	public void finalize() throws Throwable {

	}

	public Long getNutId() {
		return NutId;
	}

	public void setNutId(Long nutId) {
		NutId = nutId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public ThreadType getThreadType() {
		return ThreadType;
	}

	public void setThreadType(ThreadType threadType) {
		ThreadType = threadType;
	}

	public String getDiameter() {
		return Diameter;
	}

	public void setDiameter(String diameter) {
		Diameter = diameter;
	}

	public Unit getDiameterUnits() {
		return DiameterUnits;
	}

	public void setDiameterUnits(Unit diameterUnits) {
		DiameterUnits = diameterUnits;
	}

	public NutType getNutType() {
		return NutType;
	}

	public void setNutType(NutType nutType) {
		NutType = nutType;
	}

}