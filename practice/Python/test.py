import csv
import smtplib
from email.mime.text import MIMEText
from email.Header import Header

def sendmail(info_list):
    msg = MIMEText("Artist: WAVND Title: Moonlight Link: https://soundcloud.com/wavnd/moonlight/s-yR2io", "html", "utf-8")
    msg['Subject'] = Header("Demo", "utf-8")
    msg['From'] = "wavndmusic@gmail.com"
    msg['To'] = info_list[1]
    s = smtplib.SMTP("smtp.gmail.com")
    s.ehlo()
    s.starttls()
    s.login("wavnd", "Mawande01@")
    s.sendmail("WAVND", info_list[1], msg.as_string())

def main():
    with open("contacts2.csv", "rb") as csvfile:
        msg_reader = csv.reader(csvfile)
        msg_reader.next()
        map(lambda x: sendmail(x), msg_reader)

if __name__ == "__main__":
    main()
