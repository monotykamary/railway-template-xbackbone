#!/usr/bin/env python3
import os,requests,urllib.parse
base=os.environ['BASE_URL'].rstrip('/');user=os.environ['ADMIN_USER'];password=os.environ['ADMIN_PASSWORD']
page=requests.get(base+'/login',timeout=30);assert page.status_code==200 and 'XBackBone' in page.text
wrong=requests.Session();bad=wrong.post(base+'/login',data={'username':user,'password':'not-the-password'},allow_redirects=True,timeout=30);assert '/login' in bad.url
session=requests.Session();login=session.post(base+'/login',data={'username':user,'password':password},allow_redirects=True,timeout=30);assert login.status_code==200 and '/login' not in login.url,login.url
register=requests.get(base+'/register',timeout=30);assert register.status_code==404
print('XBackBone smoke checks passed')
