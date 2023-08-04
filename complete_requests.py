import schedule
import time
import mysql.connector

def get_requests():
	con = mysql.connector.connect(host="localhost",port="3307",user="root",password="",database="sync_requests")
	cursor = con.cursor()
	query = "SELECT * FROM sync_requests WHERE complete='0'"
	cursor.execute(query)
	sync_rows = cursor.fetchall()
	cursor.close()
	con.close()
	return sync_rows

#sync_rows[n][0] is sync_id, sync_rows[n][1] is UID, etc

def complete_requests(sync_rows):
	for sync_row in sync_rows:
		UID = sync_row[1]
		recommendations_num = sync_row[3]

		con = mysql.connector.connect(host="localhost",port="3307",user="root",password="",database="users")
		cursor = con.cursor()
		query = "SELECT * FROM users WHERE UID=%s"
		cursor.execute(query,UID)
		users_row = cursor.fetchall()
		cursor.close()
		con.close()

		user_steam_id = users_row[9]
		user_steam_key = users_row[10]
		#More rows here later when other platforms added
	return user_steam_id,user_steam_key

def process_requests(user_steam_id,user_steam_key):
	#Other parameters will be added and be NULL if they dont use/havent entered details for those platforms

	#processing algorithm goes here cba to make this rn

def requests():
	sync_rows = get_requests()
	user_steam_id,user_steam_key = complete_requests(sync_rows)
	process_requests(user_steam_id,user_steam_key)

schedule.every(10).second.do(requests())

while 1:
	schedule.run_pending() # Essentially runs the schedule line
	time.sleep(3) # Waits 3 seconds can change this to 2 or 1 depending on how long the algorithm takes to run