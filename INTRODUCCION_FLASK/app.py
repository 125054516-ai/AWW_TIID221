#importamos los paquetes de flask
from flask import Flask, render_template, request
from werkzeug.security import generate_password_hash, check_password_hash

#creamos una istancia de nuetsra aplicacion
app = Flask(__name__)
app.config['MYSQL_HOST']='localhost'
app.config['MYSQL_USER']='root'
app.config['MYSQL_PASSWORD']=''
app.config['MYSQL_DB']='FlaskDB'
#permite que flask vuelva a cargar las plantillas cuando se modifican
app.config["TEMPLATES_AUTO_RELOAD"]=True
app.secret_key='mysecretkey'


#creacion de ruta. La rura / es la ruta raiz, sera la que se mostrara cuando el proyecto corra
@app.route("/")
def home():
   return render_template("login.html")
#iniciamos el servidor FLASK en el puerto 5000
if __name__ == "__main__":
    app.run(port=500)

@app.route("/registro", methods=["GET", "POST"])
def registro():
    if request.method == "POST":
        nombre = request.form["nombre"]
        apellido_p = request.form["apellido_p"]
        apellido_m = request.form["apellido_m"]
        correo = request.form["correo"]  
        password_hash = request.form["password_hash"]
        id_rol = request.form["id_rol"]

    password_hasheada = generate_password_hash(password_hash)