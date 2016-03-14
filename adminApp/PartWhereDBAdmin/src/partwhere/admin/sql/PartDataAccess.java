package partwhere.admin.sql;

import java.util.LinkedHashMap;

public interface PartDataAccess {

	LinkedHashMap<Long, PartType> getLoadedPartTypes();
	
	PartType getPartType(Long id);

	/**
	 * This function adds the specified part type to the collection of 
	 * loaded part types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated part type
	 * @param newType the part type to add
	 */
	void addLoadedPartType(PartType newType);

	void clearLoadedPartTypes();

	LinkedHashMap<Long, MaterialType> getLoadedMaterialTypes();

	/**
	 * This function adds the specified material type to the collection of 
	 * loaded material types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated material type
	 * @param newType the material type to add
	 */
	void addLoadedMaterialType(MaterialType newType);

	void clearLoadedMaterialTypes();

	LinkedHashMap<Long, HeadType> getLoadedHeadTypes();

	/**
	 * This function adds the specified head type to the collection of 
	 * loaded head types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated head type
	 * @param newType the head type to add
	 */
	void addLoadedHeadType(HeadType newType);

	void clearLoadedHeadTypes();

	LinkedHashMap<Long, DriveType> getLoadedDriveTypes();

	/**
	 * This function adds the specified drive type to the collection of 
	 * loaded drive types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated drive type
	 * @param newType the drive type to add
	 */
	void addLoadedDriveType(DriveType newType);

	void clearLoadedDriveTypes();

	LinkedHashMap<Long, NutType> getLoadedNutTypes();

	/**
	 * This function adds the specified nut type to the collection of 
	 * loaded nut types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated nut type
	 * @param newType the nut type to add
	 */
	void addLoadedNutType(NutType newType);

	void clearLoadedNutTypes();

	LinkedHashMap<Long, TipType> getLoadedTipTypes();

	/**
	 * This function adds the specified tip type to the collection of 
	 * loaded tip types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated tip type
	 * @param newType the tip type to add
	 */
	void addLoadedTipType(TipType newType);

	void clearLoadedTipTypes();

	LinkedHashMap<Long, ThreadType> getLoadedThreadTypes();

	/**
	 * This function adds the specified thread type to the collection of 
	 * loaded thread types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated thread type
	 * @param newType the thread type to add
	 */
	void addLoadedThreadType(ThreadType newType);

	void clearLoadedThreadTypes();

	LinkedHashMap<Long, Unit> getLoadedUnits();

	/**
	 * This function adds the specified unit to the collection of 
	 * loaded units.  If an entry already exists with the same value for the ID, 
	 * this method updates the associated unit
	 * @param newType the unit to add
	 */
	void addLoadedUnit(Unit newType);

	void clearLoadedUnits();

	void addLoadedPart(Long id, Part part);
	
	LinkedHashMap<Long, Part> getLoadedPartsForType(Long partTypeId);

	public String getBaseImagePath();
	
	public void setBaseImagePath(String baseImagePath);
}