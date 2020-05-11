import pika

class RabbitConn():
    # Define rabbit connection parameters
    host = '10.0.0.101'
    port = 5672
    credentials = pika.PlainCredentials('myuser', 'mypassword')
    connectionParams = pika.ConnectionParameters(host, port, 'testHost', credentials)

    def __init__(self):
        pass
