package partwhere.admin.sql;

import java.util.LinkedHashMap;

/**
 * This helper class stores the currently loaded data from the database.  It manages an in-memory 
 * representation of the data displayed to the user.
 * @author Becky Smith
 *
 */
public class DataManager implements PartDataAccess {
	
	// singleton instance
	private static PartDataAccess instance;
	// enumerated types
	private LinkedHashMap<Long, PartType> LoadedPartTypes = new LinkedHashMap<Long, PartType>();
	private LinkedHashMap<Long, MaterialType> LoadedMaterialTypes = new LinkedHashMap<Long, MaterialType>();
	private LinkedHashMap<Long, HeadType> LoadedHeadTypes = new LinkedHashMap<Long, HeadType>();
	private LinkedHashMap<Long, DriveType> LoadedDriveTypes = new LinkedHashMap<Long, DriveType>();
	private LinkedHashMap<Long, NutType> LoadedNutTypes = new LinkedHashMap<Long, NutType>();
	private LinkedHashMap<Long, TipType> LoadedTipTypes = new LinkedHashMap<Long, TipType>();
	private LinkedHashMap<Long, ThreadType> LoadedThreadTypes = new LinkedHashMap<Long, ThreadType>();
	private LinkedHashMap<Long, Unit> LoadedUnits = new LinkedHashMap<Long, Unit>();
	
	// core data
	private LinkedHashMap<Long, Part> Parts = new LinkedHashMap<Long, Part>();
	private LinkedHashMap<Long, LinkedHashMap<Long, Part>> PartsByType = new LinkedHashMap<Long, LinkedHashMap<Long, Part>>();
	/*
	private LinkedHashMap<Long, Manufacturer> Manufacturers;
	private LinkedHashMap<Long, LinkedHashMap<Long, Part>> PartsByManufacturer;
	private LinkedHashMap<Long, LinkedHashMap<Long, PartType>> PartTypesByManufacturer;
	*/
	
	private String baseImagePath = null;
	
	private DataManager() {
		// TODO Auto-generated constructor stub
	}
	
	public static PartDataAccess getInstance()
	{
		if(instance == null)
		{
			instance = new DataManager();
		}
		return instance;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedPartTypes()
	 */
	@Override
	public LinkedHashMap<Long, PartType> getLoadedPartTypes() {
		return LoadedPartTypes;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedPartType(partwhere.admin.sql.PartType)
	 */
	@Override
	public void addLoadedPartType(PartType newType) {
		PartType existing = LoadedPartTypes.get(newType.getPartTypeId());
		if(existing == null)
		{
			LoadedPartTypes.put(newType.getPartTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedPartTypes()
	 */
	@Override
	public void clearLoadedPartTypes()
	{
		LoadedPartTypes.clear();
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedMaterialTypes()
	 */
	@Override
	public LinkedHashMap<Long, MaterialType> getLoadedMaterialTypes() {
		return LoadedMaterialTypes;
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedMaterialType(partwhere.admin.sql.MaterialType)
	 */
	@Override
	public void addLoadedMaterialType(MaterialType newType) {
		MaterialType existing = LoadedMaterialTypes.get(newType.getMaterialTypeId());
		if(existing == null)
		{
			LoadedMaterialTypes.put(newType.getMaterialTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedMaterialTypes()
	 */
	@Override
	public void clearLoadedMaterialTypes()
	{
		LoadedMaterialTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedHeadTypes()
	 */
	@Override
	public LinkedHashMap<Long, HeadType> getLoadedHeadTypes() {
		return LoadedHeadTypes;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedHeadType(partwhere.admin.sql.HeadType)
	 */
	@Override
	public void addLoadedHeadType(HeadType newType) {
		HeadType existing = LoadedHeadTypes.get(newType.getHeadTypeId());
		if(existing == null)
		{
			LoadedHeadTypes.put(newType.getHeadTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedHeadTypes()
	 */
	@Override
	public void clearLoadedHeadTypes()
	{
		LoadedHeadTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedDriveTypes()
	 */
	@Override
	public LinkedHashMap<Long, DriveType> getLoadedDriveTypes() {
		return LoadedDriveTypes;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedDriveType(partwhere.admin.sql.DriveType)
	 */
	@Override
	public void addLoadedDriveType(DriveType newType) {
		DriveType existing = LoadedDriveTypes.get(newType.getDriveTypeId());
		if(existing == null)
		{
			LoadedDriveTypes.put(newType.getDriveTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedDriveTypes()
	 */
	@Override
	public void clearLoadedDriveTypes()
	{
		LoadedDriveTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedNutTypes()
	 */
	@Override
	public LinkedHashMap<Long, NutType> getLoadedNutTypes() {
		return LoadedNutTypes;
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedNutType(partwhere.admin.sql.NutType)
	 */
	@Override
	public void addLoadedNutType(NutType newType) {
		NutType existing = LoadedNutTypes.get(newType.getNutTypeId());
		if(existing == null)
		{
			LoadedNutTypes.put(newType.getNutTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedNutTypes()
	 */
	@Override
	public void clearLoadedNutTypes()
	{
		LoadedNutTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedTipTypes()
	 */
	@Override
	public LinkedHashMap<Long, TipType> getLoadedTipTypes() {
		return LoadedTipTypes;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedTipType(partwhere.admin.sql.TipType)
	 */
	@Override
	public void addLoadedTipType(TipType newType) {
		TipType existing = LoadedTipTypes.get(newType.getTipTypeId());
		if(existing == null)
		{
			LoadedTipTypes.put(newType.getTipTypeId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedTipTypes()
	 */
	@Override
	public void clearLoadedTipTypes()
	{
		LoadedTipTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedThreadTypes()
	 */
	@Override
	public LinkedHashMap<Long, ThreadType> getLoadedThreadTypes() {
		return LoadedThreadTypes;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedThreadType(partwhere.admin.sql.ThreadType)
	 */
	@Override
	public void addLoadedThreadType(ThreadType newType) {
		ThreadType existing = LoadedThreadTypes.get(newType.getThreadId());
		if(existing == null)
		{
			LoadedThreadTypes.put(newType.getThreadId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedThreadTypes()
	 */
	@Override
	public void clearLoadedThreadTypes()
	{
		LoadedThreadTypes.clear();
	}
	
	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#getLoadedUnits()
	 */
	@Override
	public LinkedHashMap<Long, Unit> getLoadedUnits() {
		return LoadedUnits;
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#addLoadedUnit(partwhere.admin.sql.Unit)
	 */
	@Override
	public void addLoadedUnit(Unit newType) {
		Unit existing = LoadedUnits.get(newType.getUnitId());
		if(existing == null)
		{
			LoadedUnits.put(newType.getUnitId(), newType);
		}
		else
		{
			existing.update(newType);
		}
	}

	/* (non-Javadoc)
	 * @see partwhere.admin.sql.PartDataAccess#clearLoadedUnits()
	 */
	@Override
	public void clearLoadedUnits()
	{
		LoadedUnits.clear();
	}

	@Override
	public PartType getPartType(Long id) {
		return LoadedPartTypes.get(id);
	}

	@Override
	public void addLoadedPart(Long partTypeId, Part part) {
		Parts.put(part.getPartId(), part);
		LinkedHashMap<Long, Part> partsOfType = PartsByType.get(partTypeId); 
		if(partsOfType == null)
		{
			partsOfType = new LinkedHashMap<Long, Part>();
			PartsByType.put(partTypeId, partsOfType);
		}
		partsOfType.put(part.getPartId(), part);
	}

	@Override
	public LinkedHashMap<Long, Part> getLoadedPartsForType(Long partTypeId) {
		LinkedHashMap<Long, Part> retVal = new LinkedHashMap<Long, Part>();
		if(PartsByType.containsKey(partTypeId))
		{
			retVal.putAll(PartsByType.get(partTypeId));
		}
		return retVal;
	}
	
	public String getBaseImagePath() {
		return baseImagePath;
	}

	public void setBaseImagePath(String baseImagePath) {
		this.baseImagePath = baseImagePath;
	}

	
	
}
