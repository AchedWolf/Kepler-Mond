#!/usr/bin/python

# 	       Projeto Kepler - Python
#	
#	Projeto com o objetivo de movimentar um 
# telescopio, conectado a um site, por meio de um
# arduino.
#
# Autor: Vinicius Marcelo Puchille Martins
# Auxilio: Demilson Quintao
#
# Versao: 3.0

# Bibliotecas
import os
import time
import serial
import ephem
import math
import sys
from datetime import datetime
import re

# Dados de posicao
qth = ephem.Observer()
qth.lon = '-49.028118'
qth.lat = '-22.357591'
qth.elevation = 630
graus = (180./math.pi)

# Variaveis
mod = ''
tipo = ''
nome = ''
erro = ''
azp = ''
elp = ''
az = 0.
el = 0.
ajaz = 0.
ajel = 0.
ataz = 0.
atel = 0.
a = ephem
pa = ''
pe = ''
debug = True
x = 0.
y = 0.
alt = 0.
flag = True
dados = ''
test = 0
dados_sep = ['','','','0.','0.','','0.','0.']

#arduino = serial.Serial('/dev/ttyUSB0',9600)
arduino = serial.Serial('COM5',9600)
time.sleep(2)

# Funcoes
def manda(a):						# Comunicacao com o arduino
	arduino.write(a + '\n')					# Envio do comando

def atualiza():					# Atualizacao do arquivo atual.txt
	global dados

	checagem()

	if (debug):
		print ('\nAtualizando dados')	
	
	atual = open('atual.txt', 'w')				# Abre o arquivo 'atual.txt'
	
	if(debug):
		print '\nDados salvos:'	
		print (dados)					# Padrao: W:P:Az:0.00:0.00:El:0.00:0.00
								
	atual.writelines(dados + ':' + erro)			# Salva os dados no arquivo atual.txt

	atual.close()						# Salva a posicao atual no arquivo
	limpa ()						# Limpa as variaveis possiveis
	descanso()

def limpa ():						# Funcao limpar
	tipo = ''
	nome = ''
	dados = ''
	erro = ''	
	azp = ''
	elp = ''
	az = 0.
	el = 0.
	ajaz = 0.
	ajel = 0.
	a = ephem
	flag = True

def checagem ():
	flag = True						# Variavel flag
	test = 0
	global dados_sep
	global dados
	global ataz
	global atel

	print ('\nChecagem de valores.')

	while(flag):						# Recursividade para verificacao de dados
		if(debug):
			test = test + 1	
			print  test
		manda('w')						# Comando de posicao no arduino
		time.sleep(0.3)
		dados = arduino.readline().rstrip('\r\n')# Faz a leitura do retorno do arduino
		dados_sep = dados.split(':')
		if(dados_sep[0] == 'W' and dados_sep[1] == 'P' and dados_sep[2] == 'Az' and dados_sep[5] == 'El'):					# Verificacao dos dados recebidos 
			flag = False
			print (dados_sep)
			ataz = float(dados_sep[3])						# Armazena o azimute atual
			atel = float(dados_sep[6])						# Armazena a elevacao atual	

def descanso ():					# Funcao descanso
	
	if(debug):
		print ('Passagem n ' + str(alt))
		print ('-------------------- Descanso --------------------')
	time.sleep(0.01)								

# Main

while (True):						# Inicio da recursividade
	info = os.stat("comando.txt") 				# Busca das informacoes do arquivo comando.txt

	if (info.st_mtime != mod or auto == 'ON'): 		# Checa se houve alguma mudanca
		if (debug):
			print ('\nAlteracao feita ou comunicacao automatica')

		checagem()

		mod = info.st_mtime                   			# Armazena a ultima hora de modificacao do arquivo
		comando = open('comando.txt', 'ab+') 			# Abre o arquivo comando.txt	
		auto = comando.readline().rstrip('\r\n')			# Pega a primeira linha
		
		print (auto)
		if (auto == 'ON'):					# Captura dos dados
			tipo = comando.readline().rstrip('\r\n')			
			nome = comando.readline().rstrip('\r\n')
			ajaz = comando.readline().rstrip('\r\n')
			ajel = comando.readline().rstrip('\r\n')

			if(re.search('[a-zA-Z]+',ajaz,flags=0)):
				ajaz = 0.

			if(re.search('[a-zA-Z]+',ajel,flags=0)):
				el = 0.

		elif (auto == 'OFF'):
			az = comando.readline().rstrip('\r\n')
			el = comando.readline().rstrip('\r\n')

			if(re.search('[a-zA-Z]+',az,flags=0)):
				az = 0.

			if(re.search('[a-zA-Z]+',el,flags=0)):
				el = 0.
				
		else:								# Erro
			if(debug):			
				print ('\nNao foi possivel obter os dados')
			erro = ('Falha ao obter os dados.')
		
		comando.close()						# Fim da captura de dados
	
		if(auto == 'ON'):					# Modo automatico
			if (tipo == 'Asteroide'):				# Asteroides
				if (nome == '2 Pallas'):
					if(debug):	
						print ('\nCalculando 2 Pallas')
					a = ephem.Mars()
				else:
					az = 0.							    # Erro
					el = 0.
					erro = 'Asteroide nao encontrado'# Fim asteroides
                
			elif (tipo == 'Cometa'):				# Cometas
				if (nome == 'Lemmon'):
					if(debug):	
						print ('\nCalculando Lemmon')
					a = ephem.Lemmon()
				elif (nome == 'Loneos'):
					if(debug):
						print ('\nCalculando Loneos')
					a = ephem.Loneos()
				else:
					az = 0.							    # Erro
					el = 0.
					erro = 'Cometa nao encontrado'  # Fim cometas
                
			elif (tipo == 'Estrela'):				# Estrela
				if (nome == 'Sol'):					# Sol
					a = ephem.Sun ()
					if(debug):
						print ('\nCalculando Sol')
				else:							    # Estrela qualquer
					a = ephem.star (nome)       # Fim estrela
                    
			elif (tipo == 'Planetas'):				# Planetas
				if (nome == 'Marte'):					# Marte
					if(debug):
						print ('\nCalculando Marte')
					a = ephem.Mars ()
				elif (nome == 'Urano'):					# Urano
					if(debug):
						print ('\nCalculando Urano')
					a = ephem.Uranus ()	
				elif (nome == 'Jupiter'):				# Saturno
					if(debug):
						print ('\nCalculando Jupiter')
					a = ephem.Jupiter ()
				elif (nome == 'Netuno'):				# Netuno
					if(debug):					
						print ('\nCalculando Netuno')
					a = ephem.Neptune ()
				elif (nome == 'Venus'):					# Venus
					if(debug):					
						print ('\nCalculando Venus')
					a = ephem.Venus ()
				elif (nome == 'Saturno'):               		# Saturno
				  	if(debug):
						print ('\nCalculando Saturno')
				  	a = ephem.Saturn()    
				elif (nome == 'Mercurio'):              		# Mercurio
				  	if(debug):
						print ('\nCalculando Mercurio')
				  	a = ephem.Mercury()
				else:       				# Erro
					if(debug):
						print ('Planeta nao encontrado')
					erro = 'Planeta nao encontrado'		# Fim Planeta
                    
			elif (tipo == 'Satelite'):				# Satelite
				if (nome == 'Lua'):					# Lua
					if(debug):
						print ('\nCalculando Lua')
					a = ephem.Moon ()
				elif (nome == 'Hallee Bopp'):
					if(debug):	
						print ('\nCalculando Hallee Bopp')
					a = ephem.Venus()

				else:							# Erro
					az = 0.
					el = 0.
					if(debug):
						print ('\nSatelite nao encontrado')
					erro = 'Satelite nao encontrado'	# Fim Satelite
                    		
			qth.date = datetime.utcnow()				# Busca hora atual
			a.compute(qth)
	
			az = (a.az * graus) + float(ajaz)			# Convercao de horas para graus azimute
			el = (a.alt * graus) + float(ajel)			# Convercao de horas para graus elevacao
			if(debug):
				print ('Az: ' + str(az))
				print ('El: ' + str(el))		

			if ((az > 180.) or (az == 180. and ataz < 0.)):		# Consistencias
				az = (az - 360.)					

			if(el >= 0 and el <= 90):
				if(debug):
					print ('\nComunicacao com arduino: automatica')
				pa = ('azp ' + str(az)) 
				pe = ('elp ' + str(el))
				if(debug):
					print (pa)
					print (pe)

				print ('\nAz atual: ' + str(ataz))
				print ('El atual: ' + str(atel))

				manda(pa)
				manda(pe)
			else:		
				erro = ('Elevacao negativa: ' + str(el))# Fim automatico
		else:
			pa = ('azp ' + str(az))
			pe = ('elp ' + str(el))		# Monta o comando
				
			print ('\nAz atual: ' + str(ataz))
			print ('El atual: ' + str(atel))

			manda(pa)
			manda(pe)

			if(debug):			
				print ('\nComunicacao com arduino: manual')	# Modo manual
				print (pa)
				print (pe)			
									# Fim manual
	alt = float(alt + 1)

	atualiza()					# Do arduino ate o arquivo
	# time.sleep(2)


