from  datetime import datetime
	
import time
	
import psycopg2

import subprocess
	
while(0<1):
	
	nao_conectou = 0
	
	try:
		conn = psycopg2.connect("dbname='telescopio' user='kepler' host='kepler.ipmet.unesp.br' password='73aKepler!@cti'")
	except:
		print "Nao foi possivel conectar ao Banco de Dados"
		nao_conectou = 1
	
	if(nao_conectou == 0):
	#ABRE IF UM
		cur = conn.cursor()
	
		now = datetime.now()
		
		nao_executou_sql = 0

		try:
			cur.execute("SELECT hora_agen FROM agendamento WHERE data_agen = '"+str(now.strftime("%Y-%m-%d"))+"' AND hora_agen = '"+str(now.hour)+"'")
		except:	
			print "Nao executou o sql"
			nao_executou_sql = 1
		
		if(nao_executou_sql == 0):		
		#ABRE IF 2
			rows = cur.fetchall()
			conn.close()
			
			if not rows:
				flag_vazio = 1
			else:
				flag_vazio = 0

			if(flag_vazio == 0):
				if(now.minute < 50):
					tempo = 50 - now.minute
					r = subprocess.call("/var/www/html/ffmpeg/bin/ffmpeg -f alsa -ac 1 -i hw:1,0 -f v4l2 -s 1280x720 -r 10 -i /dev/video0 -t 00:"+str(tempo)+":00.000 -vcodec libx264 -pix_fmt yuv420p -preset ultrafast -r 25 -g 20 -b:v 2500k -codec:a libmp3lame -ar 44100 -threads 6 -b:a 11025 -bufsize 512k -f flv rtmp://a.rtmp.youtube.com/live2/edes-gvuh-xa7q-9zje", shell=True)
			else:
				print str(now.hour)+":"+str(now.minute)+":"+str(now.second)+" -- Nao Ha Horarios Agendados Nesse Momento"
		#FECHA IF 2
	#FCHA IF 1
	
	time.sleep(1)
#ffmpeg -f alsa -ac 1 -i hw:1,0 -f v4l2 -s 1280x720 -r 10 -i /dev/video0 -t 00:"+str(tempo)+":00.000 -vcodec libx264 -pix_fmt yuv420p -preset ultrafast -r 25 -g 20 -b:v 2500k -codec:a libmp3lame -ar 44100 -threads 6 -b:a 11025 -bufsize 512k -f flv rtmp://a.rtmp.youtube.com/live2/edes-gvuh-xa7q-9zje