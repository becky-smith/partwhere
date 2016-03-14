/**
 * 
 */
package partwhere.admin.sql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import org.apache.logging.log4j.*;

import java.sql.PreparedStatement;

/**
 * @author Becky Smith
 * This class encapsulates the database connection and communication.
 * This class does not store data - it is used to hide interaction with the 
 * database.  Data is managed in another class.
 *
 */
public class DBConnection {

	private Connection dbConnection = null;
	
	// event log
	private static Logger logger = null;
	
	private static DBConnection instance;
	
	private static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	
	//  Database credentials
	private static final String USER = "root";//"partwhere";
	private static final String PASS = "";//"p@rtWh3r3";
	   
	
	private static final String connectionString = "jdbc:mysql://localhost:3306/partwhere";
	
	private DBConnection() {
	}
	
	public static DBConnection getInstance()
	{
		if(instance == null)
		{
			instance = new DBConnection();
			try
			{
				logger = LogManager.getLogger();
			}
			catch (Exception ex)
			{
				logger = null;
			}
		}
		return instance;
	}

	private boolean initConnection()
	{
		boolean connected = true;
		try
		{
			Class.forName(JDBC_DRIVER);
			dbConnection = DriverManager.getConnection(connectionString, USER, PASS);
		}
		catch(Exception ex)
		{
			if(logger != null)
			{
				logger.error("Failed to establish database connection. Exception: ", ex);
			}
			connected = false;			
		}
		return connected;
	}
	
	public boolean loadPartTypes(PartDataAccess dataMgr)
	{
		boolean success = true;
		String query = "SELECT * FROM PartType ORDER BY ParentPartTypeId";
		if(dbConnection == null)
		{
			success = initConnection();
		}
		if(dataMgr.getBaseImagePath() == null)
		{
			loadBaseImagePath(dataMgr);
		}
		if(success)
		{
			try
			{
				Statement load = dbConnection.createStatement();
				ResultSet rs = load.executeQuery(query);
				while(rs.next())
				{
					Long id = rs.getLong("PartTypeId");
					Long parentId = rs.getLong("ParentPartTypeId");
					String name = rs.getString("Name");
					String imagePath = rs.getString("ImagePath");
					PartType type = new PartType();
					type.setPartTypeId(id);
					type.setName(name);
					if(imagePath != null && !imagePath.isEmpty())
					{
						type.setImagePath(dataMgr.getBaseImagePath() + imagePath);
					}
					if(parentId != null && parentId > 0)
					{
						PartType parent = dataMgr.getPartType(parentId);
						if(parent != null)
						{
							parent.addChild(type);
							type.setParent(parent);
						}
						else
						{
							dataMgr.addLoadedPartType(type);
						}
					}
					else
					{
						dataMgr.addLoadedPartType(type);
					}
				}
			}
			catch(Exception ex)
			{
				if(logger != null)
				{
					logger.error("Failed to retrieve PartTypes from the database table. Exception: ", ex);
				}
				success = false;
			}
		}
		return success;
	}

	public boolean loadBaseImagePath(PartDataAccess dataMgr) {
		boolean success = true;
		String query = "SELECT ConfigValue FROM config WHERE ConfigKey = \"BaseImagePath\"";
		if(dbConnection == null)
		{
			success = initConnection();
		}
		if(success)
		{
			try
			{
				Statement load = dbConnection.createStatement();
				ResultSet rs = load.executeQuery(query);
				while(rs.next())
				{
					dataMgr.setBaseImagePath(rs.getString("ConfigValue"));
				}
			}
			catch(Exception ex)
			{
				// failed to retrieve the base path - get cwd
				if(logger != null)
				{
					logger.error("Failed to retrieve BaseImagePath from the configuration table. Exception: ", ex);
				}
				dataMgr.setBaseImagePath(System.getProperty("user.dir"));
				success = false;
			}
		}
		if(logger != null)
		{
			logger.debug("Setting baseImagePath to: " + dataMgr.getBaseImagePath());
		}
		return success;
	}

	public int loadParts(Long partTypeId, PartDataAccess dataMgr) {
		int loadedParts = 0;
		boolean success = true;
		String query = "SELECT * FROM Part p JOIN PartToPartType ppt on ppt.PartId = p.PartId WHERE ppt.PartTypeId=?";
		if(dbConnection == null)
		{
			success = initConnection();
		}
		if(dataMgr.getBaseImagePath() == null)
		{
			loadBaseImagePath(dataMgr);
		}
		if(success)
		{
			try
			{
				PreparedStatement load = dbConnection.prepareStatement(query);
				load.setLong(1, partTypeId);
				ResultSet rs = load.executeQuery(query);
				while(rs.next())
				{
					Part part = new Part();
					Long id = rs.getLong("PartId");
					String name = rs.getString("Name");
					String desc = rs.getString("Description");
					String imagePath = rs.getString("ImagePath");
					part.setName(name);
					part.setDescription(desc);
					part.setPartId(id);
					if(imagePath != null && !imagePath.isEmpty())
					{
						part.setImagePath(dataMgr.getBaseImagePath() + imagePath);
					}
					dataMgr.addLoadedPart(id, part);
					loadedParts++;
				}
			}
			catch(Exception ex)
			{
				if(logger != null)
				{
					logger.error("Failed to retrieve Part from the database for part type: " + 
							partTypeId + ". Exception: ", ex);
				}
				loadedParts = 0;
			}
		}
		return loadedParts;
	}
	
	private boolean addPartType(PartType partTypeToAdd, PartDataAccess dataMgr)
	{
		boolean success = true;
		if(dbConnection == null)
		{
			success = initConnection();
		}
		if(dataMgr.getBaseImagePath() == null)
		{
			loadBaseImagePath(dataMgr);
		}
		if(success)
		{
			String query = "INSERT INTO PartType (Name";
			String values = ") VALUES (?";
			if(partTypeToAdd.getParent() != null)
			{
				query += ", ParentPartTypeId";
				values += ", ?";
			}
			if(partTypeToAdd.getImagePath() != null)
			{
				query += ", ImagePath";
				values += ", ?";
			}
			query += values + ")";
			try
			{
				PreparedStatement load = dbConnection.prepareStatement(query);
				int parameterIndex = 1;
				load.setString(parameterIndex++, partTypeToAdd.getName());
				if(partTypeToAdd.getParent() != null)
				{
					load.setLong(parameterIndex++, partTypeToAdd.getParent().getPartTypeId());					
				}
				if(partTypeToAdd.getImagePath() != null)
				{
					load.setString(parameterIndex++, dataMgr.getBaseImagePath() + partTypeToAdd.getImagePath());					
				}
				load.execute();
			}
			catch(Exception ex)
			{
				if(logger != null)
				{
					logger.error("Failed to add Part Type to the database. Exception: ", ex);
				}
			}
		}
		return success;
	}

	private boolean updatePartType(PartType partTypeToUpdate, PartDataAccess dataMgr)
	{
		boolean success = true;
		if(dbConnection == null)
		{
			success = initConnection();
		}
		if(dataMgr.getBaseImagePath() == null)
		{
			loadBaseImagePath(dataMgr);
		}
		if(success)
		{
			String query = "UPDATE PartType SET Name=?";
			if(partTypeToUpdate.getParent() != null)
			{
				query += ", ParentPartTypeId=?";
			}
			else
			{
				query += ", ParentPartTypeId=NULL";
			}
			if(partTypeToUpdate.getImagePath() != null)
			{
				query += ", ImagePath=?";
			}
			else
			{
				query += ", ImagePath=NULL";
			}
			query += " WHERE PartTypeId=" + partTypeToUpdate.getPartTypeId();
			try
			{
				PreparedStatement load = dbConnection.prepareStatement(query);
				int parameterIndex = 1;
				load.setString(parameterIndex++, partTypeToUpdate.getName());
				if(partTypeToUpdate.getParent() != null)
				{
					load.setLong(parameterIndex++, partTypeToUpdate.getParent().getPartTypeId());					
				}
				if(partTypeToUpdate.getImagePath() != null)
				{
					load.setString(parameterIndex++, dataMgr.getBaseImagePath() + partTypeToUpdate.getImagePath());					
				}
				load.execute();
			}
			catch(Exception ex)
			{
				if(logger != null)
				{
					logger.error("Failed to add Part Type to the database. Exception: ", ex);
				}
			}
		}
		return success;
	}


	public boolean savePartType(PartType partType, PartDataAccess dataMgr)
	{
		boolean success = true;
		if(partType.getPartTypeId() == null)
		{
			// add new
			success = addPartType(partType, dataMgr);
		}
		else
		{
			// existing part type - update
			success = updatePartType(partType, dataMgr);
		}
		return success;
	}

	public boolean addPart(PartType partTypeToAdd)
	{
		boolean success = true;
		return success;
	}

	public boolean updatePart(PartType partTypeToAdd)
	{
		boolean success = true;
		return success;
	}
}
