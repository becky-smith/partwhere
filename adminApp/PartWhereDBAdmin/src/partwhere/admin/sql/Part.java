package partwhere.admin.sql;

import java.util.ArrayList;
import java.util.LinkedHashMap;

/**
 * @author Becky Smith
 * @version 1.0
 * @created 19-Feb-2016 11:12:42 AM
 */
public class Part {

	protected Long PartId;
	protected String Name;
	protected String Description;
	protected String ImagePath;
	protected ArrayList<String> Aliases;
	protected LinkedHashMap<Long, MaterialType> MaterialTypes;
	protected LinkedHashMap<Long, PartType> PartTypes;

	protected Boolean dirty = false;

	public Part(){

	}

	public void finalize() throws Throwable {

	}

	public Long getPartId() {
		return PartId;
	}

	public void setPartId(Long partId) {
		PartId = partId;
	}

	public String getName() {
		return Name;
	}

	public void setName(String name) {
		Name = name;
	}

	public String getDescription() {
		return Description;
	}

	public void setDescription(String description) {
		Description = description;
	}

	public String getImagePath() {
		return ImagePath;
	}

	public void setImagePath(String imagePath) {
		ImagePath = imagePath;
	}
	
	public ArrayList<String> getAliases() {
		return Aliases;
	}
	
	public void addAlias(String alias)
	{
		if(!Aliases.contains(alias)){
			Aliases.add(alias);
		}
	}
	
	public void removeAlias(String alias)
	{
		if(Aliases.contains(alias)){
			Aliases.remove(alias);
		}
	}
	
	
	public LinkedHashMap<Long, PartType> getPartTypes() {
		return PartTypes;
	}

	/**
	 * This function adds the specified part type to the collection of 
	 * loaded part types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated part type
	 * @param newType the part type to add
	 */
	public void addPartType(PartType newType) {
		PartType existing = PartTypes.put(newType.getPartTypeId(), newType);
		if(existing != null)
		{
			// unexpected - this part type ID was already used...
		}
	}
	
	public void removePartType(PartType newType)
	{
		PartTypes.remove(newType.getPartTypeId());
	}

	public LinkedHashMap<Long, MaterialType> getMaterialTypes() {
		return MaterialTypes;
	}

	/**
	 * This function adds the specified material type to the collection of 
	 * loaded material types.  If a type already exists with the same value for the ID, 
	 * this method updates the associated material type
	 * @param newType the material type to add
	 */
	public void addMaterialType(MaterialType newType) {
		MaterialType existing = MaterialTypes.put(newType.getMaterialTypeId(), newType);
		if(existing != null)
		{
			// unexpected - this material type ID was already used...
		}
	}
	
	public void removeMaterialType(MaterialType newType)
	{
		MaterialTypes.remove(newType.getMaterialTypeId());
	}

	public Boolean getDirty() {
		return dirty;
	}

	public void setDirty(Boolean dirty) {
		this.dirty = dirty;
	}

}