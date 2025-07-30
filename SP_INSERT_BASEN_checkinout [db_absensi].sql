USE [um_db]
GO
/****** Object:  StoredProcedure [dbo].[SP_INSERT_BASEN_checkinout]    Script Date: 03/01/2024 00:26:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER OFF
GO
ALTER PROCEDURE [dbo].[SP_INSERT_BASEN_checkinout]
@userid int,
@checktype char(1),
@checktime datetime,
@tahun varchar(4),
@bulan int

AS

if(@checktype ='I')
	BEGIN
		 INSERT INTO CHECKINOUT(Userid,Checktype,Checktime,tahun,bulan,Tgl_In)VALUES(@userid,@checktype,@checktime,@tahun,@bulan,@checktime)
	END
if(@checktype ='O')
	BEGIN
		 INSERT INTO CHECKINOUT(Userid,Checktype,Checktime,tahun,bulan,Tgl_Out)VALUES(@userid,@checktype,@checktime,@tahun,@bulan,@checktime)
	END	
	
