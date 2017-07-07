#! /usr/bin/env python
# By: N4LDR / Half Baked Circuits 2017

import CHIP_IO.GPIO as GPIO
import time
import os

# Define all of the Pins you want to test.
PINS = ["XIO-P0", "XIO-P1", "XIO-P2", "XIO-P3", "XIO-P4", "XIO-P5", "XIO-P6", "XIO-P7", "CSID0"]

DELAY = .05

# SETUP
for pin in PINS:
    GPIO.setup(pin, GPIO.OUT)
    GPIO.output(pin, GPIO.LOW)

os.system('clear')
print "GPIO's Should be Toggling !, ctrl-c to stop"

# TOGGLE
dead = False
while not dead:
    try:
        for pin in PINS:
            GPIO.output(pin, GPIO.HIGH)
            time.sleep(DELAY)
            GPIO.output(pin, GPIO.LOW)
            time.sleep(DELAY)
    except KeyboardInterrupt:
        dead = True

# CLEANUP
print "\nShutting down the GPIO's\n\n"

for pin in PINS:
    GPIO.output(pin, GPIO.LOW)

GPIO.cleanup()

