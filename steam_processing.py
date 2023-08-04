import pymysql
from steam import Steam
from decouple import config


connection = pymysql.connect(host='localhost', user='root', password='', database='login_sample_db', cursorclass=pymysql.cursors.DictCursor)
cursor = connection.cursor()
cursor.execute("SELECT * FROM users")
cursor.fetchall()


#KEY = input("Enter the steam api key: ")
KEY = "26411794A112EC93D8DA87B0EE3D9360"
steam = Steam(KEY)
# arguments: steamid
#user_details = input("Enter the steam id: ")
user_details = "76571198931081916"
user_recently_played = steam.users.get_user_recently_played_games(f"{user_details}")
number_of_recents = user_recently_played['total_count']
recent_game_info = user_recently_played['games']
#{appid = appid, name = name of game, playtime_2weeks = minutes played in last 2 weeks, playtime_forever = minutes played since steam records started, rest are self explanatory}
user_owned_games = steam.users.get_owned_games(f"{user_details}") # Only works if I use my ID, I basically need to replace this with other ppl's IDs if I ask for them
user_game_count = user_owned_games['game_count']
user_games_info = user_owned_games['games']
user_badges = steam.users.get_user_badges(f"{user_details}")
user_level = steam.users.get_user_steam_level(f"{user_details}")
user_details = steam.users.get_user_details(f"{user_details}")
geometry_dash = steam.apps.search_games("geometry_dash")
#user_achievements_geometry_dash = steam.apps.get_user_achievements(f"{user_details}","322170")
print(number_of_recents)