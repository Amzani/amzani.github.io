FORMAT: 1A

# Dailymotion Graph API

The **Graph API** is a simple way to access, publish and modify data on Dailymotion. The Graph API presents a simple, consistent view of the Dailymotion objects (e.g., users, videos, playlists, etc.) and connections between them (e.g., friend relationship, user’s posted videos, videos in groups/playlits, etc.).

# Video graph object
An individual video represented in the Graph API.

## Video [/video/{id}]
A single video object. The video object is the central resource in the Dailymotion Graph API.


The Video object has the following fields : 

- id
- title
- ads
- allow_comments

+ Parameters
	+ id : the id of the video (example : x16scs1)

+ Model (application/json)

	{
	"id": "x17zmiu",
	"title": "GConnexion - Stream2 #000001",
	"channel": "videogames",
	"owner": "x1ay1d4"
	}

### Retrieve a single Video [GET]
+ Response 200
	
	[Video][]

