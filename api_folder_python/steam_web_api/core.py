import sys



# 1. Need to use base url https://api.steampowered.com
# 2. Need to use interface e.g. ISteamUser or IPlayerService
# 3. Need to use method name e.g. GetPlayerSummaries or GetPlayerAchievements
# 4. Need to include Method version e.g. v2
# 5. Parameters are optional and delimited by the '&' character e.g. key=111111111&steamod=222222222

# Response will be usually in json but it can be any three of json, vdf and xml

# I would need to get user_steam_id and user_steam_key from my database

#All methods are in this website 'https://steamwebapi.azurewebsites.net' with what is required as parameters

user_steam_key = sys.argv[1]
user_steam_id = sys.argv[2]


base_url = 'https://api.steampowered.com'