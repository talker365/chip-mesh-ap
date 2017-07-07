#!/usr/bin/env python

from luma.emulator.device import pygame
import PIL, time

device = pygame(width=128, height=64, rotate=0, mode='RGB', transform='scale2x', scale=2, frame_rate=60)
image = PIL.Image.open("images/mickey-sprite.png")
image = image.resize(device.size, PIL.Image.ANTIALIAS)
device.display(image.convert(device.mode))

time.sleep(5)


