import mysql.connector
import sys

def insert_appointment(email, name, phone, doctor, appointmentdate, appointmenttime, reason):
    try:
        # Connect to MySQL database
        conn = mysql.connector.connect(
            host="localhost",
            user="root",  # Update with your MySQL username if different
            password="",  # Update if your MySQL has a password
            database="bse"  
        )
        cursor = conn.cursor()

        # SQL query to insert appointment data
        query = """
        INSERT INTO appointments (email, name, phone, doctor, appointment_date, appointment_time, reason)
        VALUES (%s, %s, %s, %s, %s, %s, %s)
        """
        data = (email, name, phone, doctor, appointmentdate, appointmenttime, reason)

        # Execute the query and commit changes
        cursor.execute(query, data)
        conn.commit()
        print("Appointment booked successfully.")

    except mysql.connector.IntegrityError:
        print("Error: Duplicate entry. This appointment already exists.")
    except mysql.connector.Error as err:
        print(f"Database error: {err}")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cursor.close()
        conn.close()

if __name__ == "__main__":
    if len(sys.argv) != 8:
        print("Usage: python appointment.py <email> <name> <phone> <doctor> <appointment_date> <appointment_time> <reason>")
        sys.exit(1)

    # Get command-line arguments
    email = sys.argv[1]
    name = sys.argv[2]
    phone = sys.argv[3]
    doctor = sys.argv[4]
    appointment_date = sys.argv[5]
    appointment_time = sys.argv[6]
    reason = sys.argv[7]

    # Insert the appointment data into the database
    insert_appointment(email, name, phone, doctor, appointment_date, appointment_time, reason)
