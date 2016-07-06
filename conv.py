import sys

mapping = {
	'`':'K_BKQUOTE',
	'1':'K_1',
	'2':'K_2',
	'3':'K_3',
	'4':'K_4',
	'5':'K_5',
	'6':'K_6',
	'7':'K_7',
	'8':'K_8',
	'9':'K_9',
	'0':'K_0',
	'-':'K_HYPHEN',
	'=':'K_EQUAL',
	'q':'K_Q',
	'w':'K_W',
	'e':'K_E',
	'r':'K_R',
	't':'K_T',
	'y':'K_Y',
	'u':'K_U',
	'i':'K_I',
	'o':'K_O',
	'p':'K_P',
	'[':'K_LBRKT',
	']':'K_RBRKT',
	'\\':'K_BKSLASH',
	'a':'K_A',
	's':'K_S',
	'd':'K_D',
	'f':'K_F',
	'g':'K_G',
	'h':'K_H',
	'j':'K_J',
	'k':'K_K',
	'l':'K_L',
	';':'K_COLON',
	'\'':'K_QUOTE',
	'z':'K_Z',
	'x':'K_X',
	'c':'K_C',
	'v':'K_V',
	'b':'K_B',
	'n':'K_N',
	'm':'K_M',
	',':'K_COMMA',
	'.':'K_PERIOD',
	'/':'K_SLASH',
	'U+0020':'K_SPACE'
}

shiftmap = {
	'`':'~',
	'1':'!',
	'2':'@',
	'3':'#',
	'4':'$',
	'5':'%',
	'6':'^',
	'7':'&',
	'8':'*',
	'9':'(',
	'0':')',
	'-':'_',
	'=':'+',
	'q':'Q',
	'w':'W',
	'e':'E',
	'r':'R',
	't':'T',
	'y':'Y',
	'u':'U',
	'i':'I',
	'o':'O',
	'p':'P',
	'[':'{',
	']':'}',
	'\\':'|',
	'a':'A',
	's':'S',
	'd':'D',
	'f':'F',
	'g':'G',
	'h':'H',
	'j':'J',
	'k':'K',
	'l':'L',
	';':':',
	'\'':'"',
	'z':'Z',
	'x':'X',
	'c':'C',
	'v':'V',
	'b':'B',
	'n':'N',
	'm':'M',
	',':'<',
	'.':'>',
	'/':'?'
}

def quote(s):
	if s.startswith("U+"):
		return s
	if s.find('"')==-1:
		return '"{}"'.format(s)
	if s.find('\\')==-1:
		return "'{0}'".format(s)
	raise Exception("Don't know how to quote")

table = []
f = open(sys.argv[1])
for l in f:
	l = l.strip("\r\n")
	if not l:
		continue
	if l.startswith("#"):
		continue
	table.append([x.strip() for x in l.split("\t")])
f.close()

header = table.pop(0)

for r in table:
	for i in range(1, len(r)):
		v = r[i]
		raw = header[i]
		if not v:
			continue
		if not r[0]:
			k = quote(raw)
		elif r[0]=="SHIFT":
			if raw in shiftmap:
				k = quote(shiftmap[raw])
			elif raw in mapping:
				k = "[SHIFT {0}]".format(mapping[raw])
			else:
				raise Exception()
		else:
			k = "[{0} {1}]".format(r[0], mapping[raw])

		print("+ {0} > {1} dk(1)".format(k, quote(v)))
