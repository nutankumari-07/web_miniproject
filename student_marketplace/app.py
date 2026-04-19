from flask import Flask, jsonify, request
import sqlite3

app = Flask(__name__)

# Create DB + Table
def init_db():
    conn = sqlite3.connect("database.db")
    cursor = conn.cursor()

    cursor.execute("""
    CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        price INTEGER
    )
    """)

    conn.commit()
    conn.close()

init_db()

# Home route
@app.route("/")
def home():
    return "Backend with DB is running!"

# GET all products
@app.route("/products", methods=["GET"])
def get_products():
    conn = sqlite3.connect("database.db")
    cursor = conn.cursor()

    cursor.execute("SELECT * FROM products")
    rows = cursor.fetchall()

    conn.close()

    products = []
    for row in rows:
        products.append({
            "id": row[0],
            "name": row[1],
            "price": row[2]
        })

    return jsonify(products)

# ADD product
@app.route("/add-product", methods=["POST"])
def add_product():
    data = request.json

    conn = sqlite3.connect("database.db")
    cursor = conn.cursor()

    cursor.execute("INSERT INTO products (name, price) VALUES (?, ?)",
                   (data["name"], data["price"]))

    conn.commit()
    conn.close()

    return jsonify({"message": "Product added!"})

app.run(debug=True)