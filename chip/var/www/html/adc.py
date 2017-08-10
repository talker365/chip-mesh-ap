import time
import Adafruit_ADS1x15
from decimal import Decimal, getcontext
getcontext().prec = 3
adc = Adafruit_ADS1x15.ADS1115()

# Or pick a different gain to change the range of voltages that are read:
#  - 2/3 = +/-6.144V
#  -   1 = +/-4.096V
#  -   2 = +/-2.048V
#  -   4 = +/-1.024V
#  -   8 = +/-0.512V
#  -  16 = +/-0.256V
GAIN = 2

print('<table>')
values = [0]*4
names = [0]*4
names[0] = 'Panel'
names[1] = 'Battery'
names[2] = 'Output'
names[3] = 'N/C'
for i in range(4):
    # Read the specified ADC channel using the previously set gain value.
	values[i] = adc.read_adc(i, gain=GAIN)
	values[i] = (Decimal(values[i]) / Decimal(32767)) * Decimal(2.048) * (Decimal(3.25) / Decimal(1.96))
	print '<tr><td>', names[i], '</td><td>', values[i], '</td></tr>'
# Print the ADC values.
print('</table>')
