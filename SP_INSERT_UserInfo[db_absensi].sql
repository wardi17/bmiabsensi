USE [db_absensi]
GO
/****** Object:  StoredProcedure [dbo].[SP_INSERT_BASEN_checkinout]    Script Date: 02/20/2024 10:42:24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_INSERT_UserInfo]
@userid int,
@Badgenumber int,
@ssn varchar(150),
@name varchar(150),
@gender varchar(50),
@title varchar(50),
@departemenID int,
@departemenName varchar(50)

AS

	BEGIN
		DELETE FROM UserInfo WHERE  Userid =@userid and Badgenumber =@Badgenumber and SSN =@ssn AND name =@name AND gender=@gender AND
		title = @title AND departemenID =@departemenID AND  departemenName = @departemenName;
		
		 INSERT INTO UserInfo(userid,Badgenumber,SSN,gender,title,departemenID,departemenName)
		 VALUES(@userid,@Badgenumber,@ssn,@gender,@title,@departemenID,@departemenName)
		
	END


