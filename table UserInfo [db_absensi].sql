USE [db_absensi]
GO

/****** Object:  Table [dbo].[UserInfo]    Script Date: 02/20/2024 09:38:59 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[UserInfo]') AND type in (N'U'))
DROP TABLE [dbo].[UserInfo]
GO

USE [db_absensi]
GO

/****** Object:  Table [dbo].[UserInfo]    Script Date: 02/20/2024 09:38:59 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserInfo](
	[userid] [int] NOT NULL,
	[Badgenumber] [int] NULL,
	[SSN] [varchar](150) NULL,
	[name] [varchar](150) NULL,
	[gender] [varchar](50) NULL,
	[title] [varchar](50) NULL,
	[departemenID] [int] NULL,
	[departemenName] [varchar](150) NULL,
 CONSTRAINT [PK_UserInfo] PRIMARY KEY CLUSTERED 
(
	[userid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


