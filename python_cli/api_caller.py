import requests

codigo = input("Escriba el código postal: ")
url = f"http://localhost/apis/codigos_postales.php?codigo={codigo}"

response = requests.get(url)
data = response.json()

# print(data)
for colonia in data:
    print(colonia)

    