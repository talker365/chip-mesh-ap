#! /usr/bin/env python
import os
import threading
from luma.oled.device import ssd1306
from luma.core.render import canvas
from PIL import ImageFont

oled = ssd1306(port=1,address = 0x3c)

def printText():
        threading.Timer(5,printText).start()
	font = ImageFont.truetype('fonts/DejaVuSans.ttf',25)
        
#	temperatureC = os.popen("sudo axp209 --temperature").read()
	temperature = os.popen("sudo /etc/vdn/bin/battery tempf").read()
#        print temperature 
	temperature = temperature[:-1]
        temperature = temperature+"\xb0F"
	with canvas(oled) as draw:
		draw.text((15,20),temperature,font = font, fill = 255)


def main():
 	printText()
 
 
main()



