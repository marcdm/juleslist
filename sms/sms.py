#!/usr/bin/env python

import urllib
import urllib2
import json
import re

local_url = "path/to/scripts/"
data = {"function":"getDigest"
	"limit": 10}
data = urllib.urlencode(data, True)
parametrized_url = local_url + "?" + data
digest = json.loads((urllib2.urlopen(urllib2.Request(parametrized_url))).read())

values = json.loads(json_object) #convert json objects with values for get parameters

data = urllib.urlencode(values)
url_values = urllib.urlencode(data, True)
url += "?"+url_values

req = urllib2.Request(url)
response = urllib2.urlopen(req)
the_page = response.read()

dt = json.loads(the_page) #to convert to dict
js = json.dumps(dt) #to conver to json


#Response to RFQ



cropDict = {'pota' : 'potato', 'call' : 'callaloo', 'toma' : 'tomato', 'lett' : 'lettuce', 'watr' : 'watermelon'}

sms = "receivedText"
phonenum = 2345567
x = re.compile('([a-zA-Z]{3})([0-9]{3})([a-zA-Z]{4})([0-9]{3})')

for y in range(len(sms))
	rfqID = x.match(sms[y]).group(1)
	qty = x.match(sms[y]).group(2)
	cType = x.match(sms[y]).group(3)
	price = x.match(sms[y]).group(4)


local_url = "path/to/scripts/"
data = {"function":"getFarmerId"
	"phonenum":phonenum}
data = urllib.urlencode(data, True)
parametrized_url = local_url + "?" + data
farmer_id = json.loads((urllib2.urlopen(urllib2.Request(parametrized_url))).read())['id']


values = {'function':'submitRFQResponse', 'rfq_id': rfqID, 'qty': qty, 'item' : cType, 'unit_price' : price, 'farmer_id':farmer_id}


url_values = urllib.urlencode(values, True)
url = local_url + "?"+url_values
req = urllib2.Request(url)
response = urllib2.urlopen(req)

js = json.dumps()




	    




