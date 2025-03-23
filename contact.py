import mysql.connector
import sys

def insert_contact(email, name, phone, message):
    # Connect to MySQL database
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",  
            password="",  
            database="bse"  
        )
        cursor = conn.cursor()

        # SQL query to insert data
        query = "INSERT INTO contacts (email, name, phone, message) VALUES (%s, %s, %s, %s)"
        data = (email, name, phone, message)

        # Execute the query
        cursor.execute(query, data)
        conn.commit()
        print("Record inserted successfully.")
    except mysql.connector.IntegrityError:
        print("Record already exists.")
    except mysql.connector.Error as err:
        print(f"Database error: {err}")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cursor.close()
        conn.close()

if __name__ == "__main__":
    if len(sys.argv) != 5:
        print("Usage: python contact.py <email> <name> <phone> <message>")
        sys.exit(1)

    # Get command line arguments
    email = sys.argv[1]
    name = sys.argv[2]
    phone = sys.argv[3]
    message = sys.argv[4]

    # Insert the contact information
    insert_contact(email, name, phone, message)
