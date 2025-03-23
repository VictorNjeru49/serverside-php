import mysql.connector
import sys
import os
import webbrowser

def sendContactForm(Username, email, password):
    try:
        # Connect to MySQL database
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="bse"
        )
        cursor = conn.cursor()

        if not conn.is_connected():
            print("Database connection failed")
            sys.exit()

        # Check if the user already exists
        cursor.execute("SELECT * FROM register WHERE Username = %s OR email = %s", (Username, email))
        existing_user = cursor.fetchone()

        if existing_user:
            print("Error: User with this email or username already exists.")
            return False
        
        # Insert new user into database
        query = "INSERT INTO register (Username, email, password) VALUES (%s, %s, %s)"
        data = (Username, email, password)
        cursor.execute(query, data)
        conn.commit()

        print("Registration successful.")
        return show_success_message()

    except mysql.connector.IntegrityError:
        print("Error: This username or email is already registered.")
    except mysql.connector.Error as err:
        print(f"Database error: {err}")
    except Exception as e:
        print(f"Unexpected error: {e}")
    finally:
        cursor.close()
        conn.close()

def show_success_message():
    success_message = """
    <!DOCTYPE html>
    <html>
    <head>
        <title>Registration Successful</title>
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
        <h1>Registration Successful!</h1>
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
    webbrowser.open(f"file://{appointment_site_path}")
    return True

if __name__ == "__main__":
    # Ensure correct number of arguments
    if len(sys.argv) != 4:
        print("Usage: python register.py <email> <Username> <password>")
        sys.exit(1)

    # Get command line arguments
    email = sys.argv[1]
    Username = sys.argv[2]
    password = sys.argv[3]

    if sendContactForm(Username, email, password):
        print("Registration successful!")
    else:
        print("Registration failed. Please try again.")
        sys.exit(1)
