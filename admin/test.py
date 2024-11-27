""""
import requests

url = "http://localhost/crops/admin/permiso.api.php"

payload = {}
headers = {
  'Cookie': 'PHPSESSID=9nrpekmk51vtb6m1p42arjk9eq'
}

response = requests.request("GET", url, headers=headers, data=payload)

print(response.text)
"""
import requests

url = "http://localhost/crops/admin/permiso.api.php"

payload = {
    "permiso":"desde python"
}
files=[

]
headers = {
  'Cookie': 'PHPSESSID=32b10k04hu52j8otvrmbifitnm'
}

response = requests.request("POST", url, headers=headers, data=payload, files=files)

print(response.text)
