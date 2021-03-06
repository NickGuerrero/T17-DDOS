import json
import os
import requests
import time


# Use on localhost, may change as project develops
# URL = "http://127.0.0.1"
# URL = "http://" + os.environ['IP']

# Process 30 requests at a time
REQNO = 30
postImage = "test.png" # NOT LINKED
getImage = "test1.png" # NOT LINKED
results = [] # Execution Times
success = [] # Boolean array of whether requests passed or not
error = [] # Where the point of failure is

# Set up a delay
DELAY = 1
delay = time.time()
time.sleep(DELAY)
delay = time.time() - delay

print("Experiment Running")
for i in range(REQNO):
	if i % 10 == 0:
		print("Conducting test " + str(i))
	start = time.time()
	time.sleep(DELAY)
	try:
		with open("test.png", "rb") as in_image:
			# Insert a record
			ins_params = {'action': 'post', 'id': -1}
			rins = requests.post(url=URL, params=ins_params, files={'file': in_image}, stream=True)
			if not rins.ok:
				raise Exception("POST")
			rid = rins.json()['id']
			time.sleep(DELAY)

			# Get the record
			get_params = {'action': 'get', 'id': rid}
			rget = requests.get(url=URL, params=get_params, stream=True)
			if not rget.ok:
				raise Exception("GET")
			with open("test1.png", "wb") as out_image:
				out_image.write(rget.content)
			time.sleep(DELAY)
			# If the record is grabbed incorrectly, throw error

			# Delete the record
			del_params = {'action': 'delete', 'id': rid}
			rdel = requests.post(url=URL, params=del_params)
			if not rdel.ok:
				raise Exception("DELETE")
			success.append(True)
			error.append("No Error")
	except Exception as e:
		success.append(False)
		error.append("Bad")
	finally:
		end = time.time()
		results.append(end - start - (delay * 2))

# Process statistics
with open("test.log", "w") as log_file:
    for i in range(REQNO):
        log_file.write("Test " + str(i) + ":" + str(results[i]) + "|" + str(success[i]) + "|" + str(error[i]) + "\n")
print("Tests Performed: " + str(REQNO))
print("Average execution time: " + str(sum(results)/REQNO))
# Get improved execution time
tot = 0.0
for i in range(REQNO):
    if success[i]:
        tot += results[i]
print("Average successful execution time: " + str(tot/sum(success)))
print("Tests Passed: " + str(sum(success)))
