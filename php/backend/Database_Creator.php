<?php
include "Database_Connection.php";
$Today = date('Y-m-d');
if ($conn) {
	// ------------Tabel_Template------------//
	if (mysqli_select_db($conn, $Database_Name)) {
		$SQl_statement_1 = "CREATE TABLE Products(
				Product_ID     	INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Product_Name  	VARCHAR(255) NOT NULL,
				reg_date		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_1);

		$SQl_statement_2 = "CREATE TABLE Product_Units(
				Product_Unit_ID     INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Product_Unit_Name  	VARCHAR(255) NOT NULL,
				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_2);

		$SQl_statement_3 = "CREATE TABLE SP_Product_Units(
				SP_Unit_ID     			INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				FK_Product_ID  			INT(20) NOT NULL,
				FK_Product_Unit_ID  	INT(20) NOT NULL,
				SP_Original_Price  	 	Float(20) NOT NULL,
				Orignial_Price_Date  	Date NOT NULL,
				Son_Product_Unit_ID  	INT(20) NOT NULL,
				No_of_pieces            INT(20) NOT NULL,
				SP_Unit_Price 			Float(20) NOT NULL,
				reg_date				TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_3);

		$SQl_statement_4 = "CREATE TABLE People_Info(
				Person_ID     			INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Person_Name  			VARCHAR(255) NOT NULL,
				Person_Phone_1  		VARCHAR(255) NOT NULL,
				Person_Phone_2  		VARCHAR(255) NOT NULL,
				Person_Company_Name     VARCHAR(255) NOT NULL,
				Person_Address 			VARCHAR(255) NOT NULL,
				Person_Notes  			VARCHAR(255) NOT NULL,
				Person_Type				VARCHAR(255) NOT NULL,
				reg_date				TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_4);

		$SQl_statement_5 = "CREATE TABLE Document_Types(  
				Document_Type_ID    INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Document_Type_Name	VARCHAR(255) NOT NULL,
				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_5);

		$SQl_statement_6 = "CREATE TABLE Documents(  
				Document_ID    		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Document_No	   		INT(20) NOT NULL,
				Document_Date  	  	DATE NOT NULL,
				Document_Type_ID	INT(20) NOT NULL,
				Group_ID			INT(20) DEFAULT '0',
				Document_Total      INT(20) DEFAULT '0',
 				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_6);

		$SQl_statement_7 = "CREATE TABLE Statements_Logs(  
				Log_ID    			INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				statement_ID 		INT(20) NOT NULL,
				FK_Log_Type_ID		INT(20) NOT NULL,
				Log_Value 			FLOAT (20) NOT NULL,
				Log_Date 			DATE NOT NULL,
				Log_Notes 			VARCHAR (255) NOT NULL,
				Last_SUM 			FLOAT (20) NOT NULL,
				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_7);

		$SQl_statement_8 = "CREATE TABLE Statements(  
				statement_ID  		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Fk_Person_ID  	  	INT(20) NOT NULL,
				Final_statement_SUM	Float(20) NOT NULL,
				Final_Update_Date 	DATE NOT NULL,
				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_8);
		/*--Log Sign 0 For Possitve 1 For Negative----*/
		$SQl_statement_9 = "CREATE TABLE Statement_Log_Types(  
				Log_Type_ID    		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Log_Type_Name 		VARCHAR(255) NOT NULL,
				Log_Type_Sign       INT(20)	NOT NULL,
				reg_date			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				Arrangement 		INT(20) NOT NULL
			)";
		mysqli_query($conn, $SQl_statement_9);

		$SQl_statement_10 = "CREATE TABLE Application_Users(  
				User_ID    		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				User_Name 		VARCHAR(255) NOT NULL,
				User_Password   VARCHAR(255) NOT NULL,
				reg_date	    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_10);

		$SQl_statement_11 = "CREATE TABLE Stores(  
				Store_ID    	INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Store_Name 		VARCHAR(255) NOT NULL,
				Store_Type_ID   INT(20) NOT NULL,
				reg_date	    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_11);

		$SQl_statement_12 = "CREATE TABLE Stores_Qty_Logs(  
				Log_ID    		 		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				FK_Document_ID 			INT(20) NOT NULL,
				FK_From_Store_ID		INT(20) NOT NULL,
				FK_To_Store_ID 			INT(20) NOT NULL,
				FK_SP_Unit_ID   		INT(20) NOT NULL,
				Log_Qty         		Float(20) NOT NULL,
				Log_Notes         		VARCHAR(255) NOT NULL,
				Log_Date 				DATE NOT NULL,
				Log_Creator_ID			INT(20) NOT NULL,
				Log_Qty_Purchase_Price 	Float(20) NOT NULL DEFAULT '0',
				reg_date	    		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $SQl_statement_12);

		$SQl_statement_13 = "CREATE TABLE Products_Qty_In_Stores(  
			Product_Qty_ID    		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			FK_SP_Unit_ID			INT(20) NOT NULL,
			Product_Qty_In_Store 	Float(20) NOT NULL,
			FK_Store_ID    			INT(20) NOT NULL,
			Avarage_Qty_Price       Float(25) NOT NULL DEFAULT '0',
			Min_Qty_In_Store        Float(25) NOT NULL DEFAULT '0',
			Last_Update 			DATE NOT NULL,
			reg_date	    		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		mysqli_query($conn, $SQl_statement_13);

		$SQl_statement_14 = "CREATE TABLE Bills_Folders(  
			Bills_Folder_ID    		INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Bills_Folder_No			INT(20) NOT NULL,
			Bills_Folder_Date 	    DATE NOT NULL,
			Folder_Total_Value      FLOAT(20) NOT NULL DEFAULT '0',
			Folder_Sum_Bills        INT(25) NOT NULL DEFAULT '0',
			Folder_Notes            VARCHAR(255) NOT NULL DEFAULT '-----',
			reg_date	    		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		mysqli_query($conn, $SQl_statement_14);

		$SQl_statement_Tr1 = "CREATE TRIGGER After_Statement_Log
			AFTER INSERT
			ON Statements_Logs FOR EACH ROW
			UPDATE Statements SET Final_statement_SUM = (NEW.Last_SUM + NEW.Log_Value) , Final_Update_Date = NEW.Log_Date  
			Where statement_ID = NEW.statement_ID";
		mysqli_query($conn, $SQl_statement_Tr1);

		$SQl_statement_Tr2 = "CREATE TRIGGER After_New_Person
			AFTER INSERT
			ON People_Info FOR EACH ROW
			INSERT INTO Statements (Fk_Person_ID,Final_statement_SUM,Final_Update_Date) Values (NEW.Person_ID,0,'$Today')";
		mysqli_query($conn, $SQl_statement_Tr2);

		$SQl_statement_Tr3 = "CREATE TRIGGER After_Qty_Log
			AFTER INSERT
			ON Stores_Qty_Logs FOR EACH ROW
			CALL `Qty_Procedure`(NEW.FK_SP_Unit_ID, NEW.FK_From_Store_ID, NEW.FK_To_Store_ID, NEW.Log_Qty, NEW.Log_Qty_Purchase_Price, NEW.Log_Date, @p6); 
			SELECT @p6 AS `pAction_Done`";
		mysqli_query($conn, $SQl_statement_Tr3);

		// ------------View_Template-------------//
		$SQl_statement_V1 = "CREATE VIEW Final_Products_Info AS SELECT
			SP_Product_Units.SP_Unit_ID, 
			Product_Units.Product_Unit_Name     AS SP_Unit_Name, 
			Products.Product_Name AS FK_Product_Name, 
			SP_Product_Units.SP_Unit_Price,
			SP_Product_Units.SP_Original_Price,
			SP_Product_Units.Orignial_Price_Date,
			SP_Product_Units.FK_Product_ID, 
			SP_Product_Units.FK_Product_Unit_ID, 
			SP_Product_Units.No_of_pieces, 
			SP_Product_Units.Son_Product_Unit_ID,
			SP_Product_Units.Person_ID,
			(SELECT Person_Name FROM People_Info WHERE Person_ID = SP_Product_Units.Person_ID) AS Person_Name,
			Product_Son_Units.Product_Unit_Name AS Son_Unit_Name,
			(SELECT SUM(Product_Qty_In_Store) FROM  Products_Qty_In_Stores WHERE SP_Product_Units.SP_Unit_ID = Products_Qty_In_Stores.FK_SP_Unit_ID AND FK_Store_ID !=6) AS Total_Qty
			FROM
			SP_Product_Units
			LEFT JOIN
			Products
			ON 
				SP_Product_Units.FK_Product_ID = Products.Product_ID
			LEFT JOIN
			Product_Units
			ON 
				SP_Product_Units.FK_Product_Unit_ID = Product_Units.Product_Unit_ID
			INNER JOIN
			Product_Units AS Product_Son_Units
			ON 
				SP_Product_Units.Son_Product_Unit_ID = Product_Son_Units.Product_Unit_ID
			";
		mysqli_query($conn, $SQl_statement_V1);

		$SQl_statement_V2 = "CREATE VIEW All_Vendor_Statements AS SELECT
			People_Info.Person_ID, 
			People_Info.Person_Type, 
			Statements.statement_ID, 
			Statements.Final_Update_Date, 
			Statements.Final_statement_SUM, 
			People_Info.Person_Name
			FROM
			People_Info
			LEFT JOIN
			Statements
			ON 
				People_Info.Person_ID = Statements.Fk_Person_ID;";
		mysqli_query($conn, $SQl_statement_V2);


		$SQl_statement_V3 = "CREATE VIEW VD_Statement_Logs AS SELECT
			Statements_Logs.Log_ID, 
			Statements_Logs.statement_ID, 
			Statements_Logs.FK_Log_Type_ID, 
			Statement_Log_Types.Log_Type_Name, 
			Statement_Log_Types.Log_Type_Sign, 
			Statements_Logs.Log_Value, 
			Statements_Logs.Log_Date, 
			Statements_Logs.Log_Notes, 
			Statements_Logs.Last_SUM, 
			Statements_Logs.reg_date
			FROM
			Statements_Logs
			LEFT JOIN
			Statement_Log_Types
			ON 
				Statements_Logs.FK_Log_Type_ID = Statement_Log_Types.Log_Type_ID;";
		mysqli_query($conn, $SQl_statement_V3);

		$SQl_statement_V4 = "CREATE VIEW VD_Statement_Person_INFO AS SELECT
			Statements.statement_ID, 
			People_Info.Person_Name, 
			People_Info.Person_Phone_1, 
			People_Info.Person_Phone_2, 
			People_Info.Person_Company_Name, 
			People_Info.Person_Type, 
			Statements.Final_statement_SUM, 
			Statements.Final_Update_Date, 
			People_Info.Person_Address, 
			People_Info.Person_Notes, 
			Statements.Fk_Person_ID
			FROM
			Statements
			LEFT JOIN
			People_Info
			ON 
			Statements.Fk_Person_ID = People_Info.Person_ID;";
		mysqli_query($conn, $SQl_statement_V4);


		$SQl_statement_V5 = "CREATE VIEW VD_Products_Qty_In_Stores AS SELECT
			Products_Qty_In_Stores.Product_Qty_ID, 
			Products_Qty_In_Stores.FK_SP_Unit_ID, 
			Products_Qty_In_Stores.Product_Qty_In_Store, 
			Products_Qty_In_Stores.FK_Store_ID,
			Products_Qty_In_Stores.Avarage_Qty_Price,
			Products_Qty_In_Stores.Min_Qty_In_Store,
			(SELECT Store_Name FROM Stores Where Store_ID = Products_Qty_In_Stores.FK_Store_ID) AS Store_Name,
			Final_Products_Info.SP_Unit_Name,
			Final_Products_Info.SP_Unit_Price,
			Final_Products_Info.FK_Product_Name,
			Final_Products_Info.SP_Original_Price,
			Final_Products_Info.No_of_pieces,
			Final_Products_Info.Son_Product_Unit_ID,
			Final_Products_Info.Son_Unit_Name,
			Final_Products_Info.Total_Qty
			FROM
			Products_Qty_In_Stores 
			LEFT JOIN
			Final_Products_Info
			ON 
			Products_Qty_In_Stores.FK_SP_Unit_ID = Final_Products_Info.SP_Unit_ID;";
		mysqli_query($conn, $SQl_statement_V5);

		$SQl_statement_V6 = "CREATE VIEW VD_Stores_Qty_Logs AS SELECT
			Stores_Qty_Logs.Log_ID, 
			Stores_Qty_Logs.FK_Document_ID, 
			Stores_Qty_Logs.Log_Qty, 
			Stores_Qty_Logs.Log_Date,
			Stores_Qty_Logs.Log_Qty_Purchase_Price,
			Stores_Qty_Logs.FK_SP_Unit_ID,
			(SELECT FK_Product_Name FROM Final_Products_Info Where SP_Unit_ID = Stores_Qty_Logs.FK_SP_Unit_ID) AS FK_Product_Name,
			(SELECT No_of_pieces FROM Final_Products_Info Where SP_Unit_ID = Stores_Qty_Logs.FK_SP_Unit_ID) AS No_of_pieces,
			(SELECT SP_Unit_Name FROM Final_Products_Info Where SP_Unit_ID = Stores_Qty_Logs.FK_SP_Unit_ID) AS SP_Unit_Name,
			(SELECT Son_Unit_Name FROM Final_Products_Info Where SP_Unit_ID = Stores_Qty_Logs.FK_SP_Unit_ID) AS Son_Unit_Name
			FROM
			Stores_Qty_Logs Where 1=1";
		mysqli_query($conn, $SQl_statement_V6);



		$SQl_statement_P1 = "DELIMITER $$
		CREATE PROCEDURE `Qty_Procedure`(IN `pFK_SP_Unit_ID` INT, 
		 IN `pFK_From_Store_ID` INT, 
		 IN `pFK_To_Store_ID` INT, 
		 IN `pLog_Qty` FLOAT, 
		 IN `pLog_Qty_Purchase_Price` FLOAT, 
		 IN `pToday` DATE, 
		 OUT `pAction_Done` VARCHAR(255)
		)
		BEGIN
		-- In Case That Qty Is From a Vendor (pFK_From_Store_ID == 1)
			DECLARE pProduct_Qty_ID INT DEFAULT 0;
			DECLARE pOld_Qty_In_To_Store FLOAT DEFAULT 0;
			DECLARE pOld_Qty_In_From_Store FLOAT DEFAULT 0;
			DECLARE pOld_Qty_Price_In_TO_Store INT DEFAULT 0;
			DECLARE pNew_Avarage_Price INT DEFAULT 0;
			DECLARE pNew_Product_Qty FLOAT DEFAULT 0;
			DECLARE pProduct_Qty_ID_Form INT DEFAULT 0;
			DECLARE pProduct_Qty_ID_To   INT DEFAULT 0;
			
			IF pFK_From_Store_ID = 1 THEN
				SELECT Product_Qty_ID 
				INTO pProduct_Qty_ID
				FROM Products_Qty_In_Stores
				WHERE FK_SP_Unit_ID = pFK_SP_Unit_ID And FK_Store_ID = pFK_To_Store_ID ;
				-- In Case That Product Is Not Into The Store 
				IF pProduct_Qty_ID = 0 THEN
					INSERT INTO Products_Qty_In_Stores
					(FK_SP_Unit_ID,Product_Qty_In_Store,FK_Store_ID,Avarage_Qty_Price,Last_Update) 
					VALUES (pFK_SP_Unit_ID,pLog_Qty,pFK_To_Store_ID,pLog_Qty_Purchase_Price,pToday);
					SET pAction_Done = 'Inserted';
				ELSE
					SELECT Product_Qty_In_Store 
					INTO pOld_Qty_In_To_Store
					FROM Products_Qty_In_Stores
					WHERE Product_Qty_ID = pProduct_Qty_ID;
		
					SELECT Avarage_Qty_Price 
					INTO pOld_Qty_Price_In_TO_Store
					FROM Products_Qty_In_Stores
					WHERE Product_Qty_ID = pProduct_Qty_ID ;
		 
					SET pNew_Avarage_Price = ( pOld_Qty_Price_In_TO_Store+ (pLog_Qty_Purchase_Price / pLog_Qty) ) / 2;
					SET pNew_Product_Qty   = (pOld_Qty_In_To_Store  + pLog_Qty);
					
					Update Products_Qty_In_Stores 
					SET Avarage_Qty_Price = pNew_Avarage_Price,
					Product_Qty_In_Store = pNew_Product_Qty
					WHERE Product_Qty_ID = pProduct_Qty_ID;
					SET pAction_Done = 'Qty_Updated';
				END IF;
			ELSE
				SELECT Product_Qty_ID 
				INTO pProduct_Qty_ID_Form
				FROM Products_Qty_In_Stores
				WHERE FK_SP_Unit_ID = pFK_SP_Unit_ID And FK_Store_ID = pFK_From_Store_ID ;
		
				SELECT Product_Qty_In_Store 
				INTO pOld_Qty_In_From_Store
				FROM Products_Qty_In_Stores
				WHERE Product_Qty_ID = pProduct_Qty_ID_Form;
		
				SELECT Product_Qty_ID 
				INTO pProduct_Qty_ID_To
				FROM Products_Qty_In_Stores
				WHERE FK_SP_Unit_ID = pFK_SP_Unit_ID And FK_Store_ID = pFK_To_Store_ID ;
		
				SELECT Product_Qty_In_Store 
				INTO pOld_Qty_In_To_Store
				FROM Products_Qty_In_Stores
				WHERE Product_Qty_ID = pProduct_Qty_ID_To;
		
				Update Products_Qty_In_Stores 
				SET Product_Qty_In_Store = (pOld_Qty_In_From_Store - pLog_Qty)
				WHERE Product_Qty_ID = pProduct_Qty_ID_Form;
		
				IF pProduct_Qty_ID_To = 0 THEN
					SELECT Avarage_Qty_Price 
					INTO pOld_Qty_Price_In_TO_Store
					FROM Products_Qty_In_Stores
					WHERE Product_Qty_ID = pProduct_Qty_ID_Form ;
		
					INSERT INTO Products_Qty_In_Stores
					(FK_SP_Unit_ID,Product_Qty_In_Store,FK_Store_ID,Avarage_Qty_Price,Last_Update) 
					VALUES (pFK_SP_Unit_ID,pLog_Qty,pFK_To_Store_ID,pOld_Qty_Price_In_TO_Store,pToday);
					SET pAction_Done = 'Inserted';
				ELSE
					Update Products_Qty_In_Stores 
					SET Product_Qty_In_Store = (pOld_Qty_In_To_Store + pLog_Qty)
					WHERE Product_Qty_ID = pProduct_Qty_ID_To;
				END IF;
			END IF;
		END$$
		DELIMITER ;";
		mysqli_query($conn, $SQl_statement_P1);
	}
}
