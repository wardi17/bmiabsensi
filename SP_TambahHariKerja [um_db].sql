USE [um_db]
GO
/****** Object:  StoredProcedure [dbo].[SP_TambahHariKerja]    Script Date: 04/25/2024 11:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TambahHariKerja]
@tahun int,
@bulan int,
@hk int

AS


        IF EXISTS(SELECT * FROM [um_db].[dbo].hariKerja_absensi WHERE tahun=@tahun AND bulan=@bulan)
            BEGIN
                UPDATE  [um_db].[dbo].hariKerja_absensi SET lhk=@hk WHERE  tahun=@tahun AND bulan=@bulan;
            END
        ELSE
            BEGIN 
            
             INSERT INTO [um_db].[dbo].hariKerja_absensi(tahun,bulan,lhk)VALUES(@tahun,@bulan,@hk);
            END

--GO

--EXEC SP_TambahHariKerja '2023','1','22';
