USE [um_db]
GO

/****** Object:  Table [dbo].[absenHasilTransaksi]    Script Date: 04/25/2024 11:15:38 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[absenHasilTransaksi](
	[userid] [int] NULL,
	[ssn] [varchar](150) NULL,
	[nama] [varchar](150) NULL,
	[departemenID] [int] NULL,
	[departemenName] [varchar](150) NULL,
	[jabatan] [varchar](100) NULL,
	[hadir] [float] NULL,
	[lembur] [float] NULL,
	[tahun] [int] NULL,
	[bulan] [int] NULL,
	[harikerja] [int] NULL,
	[saleri] [float] NULL,
	[gapok] [float] NULL,
	[gaji_lembur] [float] NULL,
	[gaji_diterima] [float] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


