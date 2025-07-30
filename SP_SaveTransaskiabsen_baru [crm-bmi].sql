USE [crm-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_SaveTransaskiabsen]    Script Date: 04/25/2024 11:17:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_SaveTransaskiabsen]
@tahun varchar(4),
@bulan int,
@userid int,
@nama varchar(150),
@departemenName varchar(150),
@jabatan varchar(100),
@ssn varchar(100),
@masukkerja float,
@lembur float
AS
BEGIN
 DECLARE @departemenID int ;
 DECLARE @hka int ;
 DECLARE @saleri float ;
 DECLARE @gapok float;
 DECLARE @gjhlembur float;
 DECLARE @gjh_diterima float;
 
 SET @departemenID =(SELECT departemenID FROM [um_db].[dbo].UserInfo WHERE userid=@userid);
 SET @hka =(SELECT lhk FROM [um_db].[dbo].hariKerja_absensi WHERE tahun=@tahun AND bulan=@bulan);
 SET @saleri =(SELECT saleri FROM [um_db].[dbo].master_op WHERE userid=@userid);
 SET @gapok =((@masukkerja/@hka) * @saleri);
  SET @gjhlembur =(@lembur *(@gapok/@hka/8));
	
	SET @gjh_diterima = (@gapok + @gjhlembur);
END
 BEGIN 
	
	
	INSERT INTO [um_db].[dbo].absenHasilTransaksi(userid,ssn,nama,departemenID,departemenName,jabatan,hadir,lembur,tahun,bulan,harikerja,saleri,gapok,gaji_lembur,gaji_diterima)
	VALUES(@userid,@ssn,@nama,@departemenID,@departemenName,@jabatan,@masukkerja,@lembur,@tahun,@bulan,@hka,@saleri,@gapok,@gjhlembur,@gjh_diterima)
	
	
	
 END
	
	

--go 

--exec SP_SaveTransaskiabsen '2024','2','121','Nurayu Suwandi','07 ADMIN BMI','OP','1122065','7.5','0'
