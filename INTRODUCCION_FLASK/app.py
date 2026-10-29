#importamos los paquetes de flask
from flask import Flask, render_template, request, redirect, url_for
from flask_mysqldb import MySQL
from werkzeug.security import generate_password_hash, check_password_hash

#creamos una istancia de nuetsra aplicacion
app = Flask(__name__, template_folder='.')
app.config['MYSQL_HOST']='localhost'
app.config['MYSQL_USER']='root'
app.config['MYSQL_PASSWORD']=''
app.config['MYSQL_DB']='FlaskDB'
#permite que flask vuelva a cargar las plantillas cuando se modifican
app.config["TEMPLATES_AUTO_RELOAD"]=True
app.secret_key='mysecretkey'
mysql = MySQL(app)


#creacion de ruta. La rura / es la ruta raiz, sera la que se mostrara cuando el proyecto corra
@app.route("/login", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        correo = request.form["correo"]
        password = request.form["password"]
        cur = mysql.connection.cursor()
        cur.execute("SELECT password_hash FROM usuarios WHERE correo=%s", (correo,))
        row = cur.fetchone()
        cur.close()
        if row and check_password_hash(row[0], password):
            return redirect(url_for("home"))
        return render_template("login.html", error="Credenciales inválidas")
    return render_template("login.html")
#iniciamos el servidor FLASK en el puerto 5000
if __name__ == "__main__":
    app.run(port=8012)

@app.route("/admin")
def admin():
    cur = mysql.connection.cursor()
    cur.execute("SELECT id, nombre, apellido_p, apellido_m, correo, id_rol FROM usuarios")
    data = cur.fetchall()
    cur.close()
    return render_template("admin.html", usuarios=data)
def usuarios():
    cur = mysql.connection.cursor()
    cur.execute("SELECT id, nombre, apellido_p, apellido_m, correo, id_rol FROM usuarios")
    data = cur.fetchall()
    cur.close()
    return render_template("usuarios.html", usuarios=data)
def registro():
    if request.method == "POST":
        nombre = request.form["nombre"]
        apellido_p = request.form["apellido_p"]
        apellido_m = request.form["apellido_m"]
        correo = request.form["correo"]  
        password_hash = request.form["password"]
        id_rol = request.form["id_rol"]

        password_hasheada = generate_password_hash(password_hash)
        cur = mysql.connection.cursor()
        cur.execute("INSERT INTO usuarios (nombre, apellido_p, apellido_m, correo, password_hash, id_rol) VALUES (%s,%s,%s,%s,%s,%s)", (nombre, apellido_p, apellido_m, correo, password_hasheada, id_rol))
        mysql.connection.commit()
        cur.close()

        return redirect(url_for("home"))
    return render_template("registro.html")