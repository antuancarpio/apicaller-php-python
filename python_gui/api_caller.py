from tkinter import Tk, Label, Entry, Button, ttk
import requests

def call_api(codigo_postal):
    url = f"http://localhost/apis/codigos_postales.php?codigo={codigo_postal}"

    response = requests.get(url)
    data = response.json()

    combo["values"] = data
    combo.current(0)

ventana = Tk()
ventana.geometry("600x200")

# Label
label = Label(ventana,text="Escribe el código postal")
label.place(x=10, y=10)

# Entry
textBox = Entry(ventana)
textBox.place(x=160, y=10)

# Button
button = Button(ventana, text="Buscar", command=lambda :call_api(textBox.get()))
button.place(x=300, y=10)

# Combo
combo = ttk.Combobox(ventana)
combo.place(x=360, y=10)

# Esta línea siempre va al final
ventana.mainloop()
