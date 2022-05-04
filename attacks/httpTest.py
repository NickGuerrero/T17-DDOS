import json
import os
import requests

# Use on localhost, may change as project develops
URL = "http://127.0.0.1"


# Insert a record
# insert_params =


# Get the record
get_params = {'action': 'get', 'id': 1}
rget = requests.get(url = URL, params = get_params, stream=True)
with open("test.png", "wb") as test_image:
	test_image.write(rget.content)

# Delete the record
# delete_params =
