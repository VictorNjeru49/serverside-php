import mysql.connector
import sys
import os
import webbrowser

def login(Username, password):
    try:
        conn = mysql.connector.connect(
            host="localhost", 
            user="root", 
            password="", 
            database="bse"
        )
        cursor = conn.cursor()

        if not conn.is_connected():
            print("Connection failed")
            sys.exit()

        query = "SELECT * FROM register WHERE Username = %s AND password = %s"
        data = (Username, password)

        cursor.execute(query, data)
        result = cursor.fetchone()

        if result:
            print("Login successful!")
            return show_success_message()
        else:
            print("Invalid username or password. Please register.")
            return False
    except mysql.connector.Error as err:
        print(f"Database error: {err}")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cursor.close()
        conn.close()

def show_success_message():
    success_message = """
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login Successful</title>
        <style>
            body {{
                font-family: Arial, sans-serif;
                text-align: center;
                margin-top: 50px;
            }}
            button {{
                padding: 10px 20px;
                font-size: 16px;
            }}
        </style>
    </head>
    <body>
        <h1>Login Successful!</h1>
        <button onclick="openAppointmentSite()">Go to Appointment Site</button>
        <script>
            function openAppointmentSite() {{
                window.location.href = 'file://{appointment_site_path}';
            }}
        </script>
    </body>
    </html>
    """

    appointment_site_path = os.path.join(os.path.dirname(__file__), "appointment.html")

    # with open("success.html", "w") as f:
    #     f.write(success_message.format(appointment_site_path=appointment_site_path))

    webbrowser.open(f"file://{appointment_site_path}")
    # .format(os.path.join(os.path.dirname(__file__), "success.html"))
    return True

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python login.py <Username> <password>")
        sys.exit(1)

    Username = sys.argv[1]
    password = sys.argv[2]

    if login(Username, password):
        print("Login successful!")
    else:
        print("Invalid username or password. Please register.")
        sys.exit(1)
