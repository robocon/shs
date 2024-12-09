DOCUMENTATION:
https://developers.line.biz/en/reference/messaging-api/#send-push-message

แนวทาง:
https://medium.com/linedevth/line-notify-migration-tips-0432e5f7af6e

ตัวอย่าง HOOK:
https://webhook.site/


METHODS:
POST https://api.line.me/v2/bot/message/push

HEADER:
Authorization: Bearer XXXXXX

BODY:
{
    "to":"C485d6170a83ec2fba0a57e98a9bc8374",
    "messages":[{
        "type":"text",
        "text":"ทดสอบส่งข้อความ POSTMAN จาก Line Message api ก่อนที่ Linebot notify จะหมดอายุการใช้งาน"
    }]
}



curl -v -X POST https://api.line.me/v2/bot/message/push \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {channel access token}' \
-H 'X-Line-Retry-Key: {UUID}' \
-d '{
    "to": "U4af4980629...",
    "messages":[
        {
            "type":"text",
            "text":"Hello, world1"
        },
        {
            "type":"text",
            "text":"Hello, world2"
        }
    ]
}'