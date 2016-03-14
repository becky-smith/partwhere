package partwhere.admin.sql;


/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:12:18 AM
 */
public class Screw extends Part{

	private Long ScrewId;
	private String Diameter;
	private Unit DiameterUnits;
	private String Length;
	private Unit LengthUnits;
	private Boolean FlangedHead = false;
	private ThreadType ThreadType;
	private DriveType Drive;
	private TipType Tip;
	private HeadType Head;

	public Screw(){

	}

	public void finalize() throws Throwable {

	}

	public Long getScrewId() {
		return ScrewId;
	}

	public void setScrewId(Long screwId) {
		ScrewId = screwId;
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

	public String getLength() {
		return Length;
	}

	public void setLength(String length) {
		Length = length;
	}

	public Unit getLengthUnits() {
		return LengthUnits;
	}

	public void setLengthUnits(Unit lengthUnits) {
		LengthUnits = lengthUnits;
	}

	public Boolean getFlangedHead() {
		return FlangedHead;
	}

	public void setFlangedHead(Boolean flangedHead) {
		FlangedHead = flangedHead;
	}

	public ThreadType getThreadType() {
		return ThreadType;
	}

	public void setThreadType(ThreadType threadType) {
		ThreadType = threadType;
	}

	public DriveType getDrive() {
		return Drive;
	}

	public void setDrive(DriveType drive) {
		Drive = drive;
	}

	public TipType getTip() {
		return Tip;
	}

	public void setTip(TipType tip) {
		Tip = tip;
	}

	public HeadType getHead() {
		return Head;
	}

	public void setHead(HeadType head) {
		Head = head;
	}

}