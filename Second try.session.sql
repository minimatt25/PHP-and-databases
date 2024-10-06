UPDATE people
SET password = hash("cheese1234")
WHERE email = "matt123@gmail.com"