import sys, math, re


def password_strength(password):
    strength = 0

    length = len(password)
    uppercase = len(re.findall(r'[A-Z]', password))
    lowercase = len(re.findall(r'[a-z]', password))
    digits = len(re.findall(r'[0-9]', password))
    symbols = len(re.findall(r'[$#@]', password))

    if 7 >= length >= 1:
        strength += 5
    elif 11 > length >= 8:
        strength += 10
    elif length >= 12:
        strength += 20

    if uppercase == 1:
        strength += 10
    else:
        strength += 20

    if lowercase >= 1:
        strength += 5

    if digits >= 1:
        strength += 10
    elif digits >= 12:
        strength += 20

    if 1 <= symbols < 3:
        strength += 10
    elif symbols > 3:
        strength += 20

    if length >= 8 and uppercase >= 1 and lowercase >= 1 and digits >= 1 and symbols >= 1:
        strength += 15

    return strength
